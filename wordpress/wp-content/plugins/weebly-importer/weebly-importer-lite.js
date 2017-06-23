jQuery(document).ready(function($) {

    $("#import").click(function(event) {
        importWeeblyBlog();
    });

    function importWeeblyBlog() {
        event.preventDefault();

        $.crawling = {
            'post': true
        };

        // Clear status reports.
        $('#progress').text('');

        var importOptions = [];
        $("[type=checkbox]:checked").each(function() {
            importOptions.push(this.id.replace('weebly2wp-', ''));
        });

        $.ajax({
            type:'POST',
            data: {
                'action': 'import',
                'url': $('#weebly2wp-url').val(),
                'options': importOptions
            },
            dataType: 'json',
            url: ajaxurl,
            success: function(data) {
                console.log('FINISHED IMPORTING: ' + JSON.stringify(data));
                updateStats(data);
            },
            error: function(errorThrown){
                console.log(errorThrown);
            }
        });

        // Poll for import status, until we're done importing.
        doPoll();
    }

    function doPoll() {
        console.log('Polling ...');
        $.ajax({
            type:'POST',
            url: ajaxurl,
            datatype: 'json',
            data: {
                'action': 'import_status'
            },
            success: function(data) {
                console.log('Poll report: [' + JSON.stringify(data) + ']');
                updateStats(data);

                if ($.crawling['post']) {
                    setTimeout(doPoll(), 2000);
                }
            },
            error: function(errorThrown){
                console.log(errorThrown);
            }
        });
    }

    function updateStats(data) {
        var statusParams = {
            post: {
                processed: 'processed_posts',
                total: 'total_posts',
                singular: 'post',
                plural: 'posts',
                el: '#progress'
            }
        };

        $.each(statusParams, function(key, val) {
            var d = data[key];
            var totalCount = d[val['total']];
            var singular = val['singular'];
            var plural = val['plural'];
            var text = d['status'];

            if (d['status'] === 'CRAWLING' || d['status'] === 'DONE_CRAWLING') {
                var processedCount =  d[val['processed']];
                text = 'Importing ' + plural;
                text += ' from the archive';
                singular = 'archive';
                plural = 'archives';
                totalCount = d['total_archives'];
                processedCount = d['processed_archives'];
                text += ' (' + processedCount + ' of ' + totalCount + ' ' + plural + ' processed) ...';

                if (d['status'] === 'DONE_CRAWLING') {
                    text = 'Successfully imported ' +  totalCount + ' ' + (totalCount % 100 === 1 ? singular : plural);
                    if (totalCount == 0) {
                        text = 'Successfully crawled your Weebly blog but got no ' + plural;
                    }
                }
            }

            if ($.crawling[key]) {
                var el = $(val['el']);
                el.text(text);
                $.crawling[key] = d['status'] !== 'DONE_CRAWLING';
            }
        });
    }

});

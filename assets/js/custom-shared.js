$(document).ready(function(){
   var substringMatcher = function(strs) {
    return function findMatches(q, cb) {
      var matches, substringRegex;
      matches = [];
      substrRegex = new RegExp(q, 'i');
      $.each(strs, function(i, str) {
        if (substrRegex.test(str)) {
          matches.push({ value: str });
        }
      });

      cb(matches);
    };
  };
//valid entries (items)
  var items = ['Item1',
    'Item2'
  ];

  $('#field1').typeahead({
    hint: true,
    highlight: true,
    minLength: 1
  },
  {
    name: 'items',
    displayKey: 'value',
    source: substringMatcher(items)
  });
  $("#carousel-slider").norse_transitions('form');
})
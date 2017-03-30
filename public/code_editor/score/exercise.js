

$(document).ready(function(){

  var myCodeMirror = CodeMirror.fromTextArea(document.getElementById('csharp_editor'),{
     mode:  "text/x-csharp",
     lineNumbers: true,
     matchBrackets: true,
     autoCloseBrackets: true
   });

   $("#score-photo").raty({
     path     : '/images',
     hints: ['继续努力', '菜鸟编程者', '次级程序员', '准初级程序员', '初级程序员'],
     number   : 5,
     readOnly : true,
     score    : 2,
     starOn : 'medal-on.png',
     starOff: 'medal-off.png'
   });
})

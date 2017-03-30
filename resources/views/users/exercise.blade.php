<!DOCTYPE html>
<html>
  <head>
    <title>控制算法练习</title>
    <link rel="shortcut icon" href="/images/icon.ico" type="image/x-icon" />
    <script src="/code_editor/lib/codemirror.js"></script>
    <link rel="stylesheet" href="/code_editor/lib/codemirror.css">
    <script src="/code_editor/addon/edit/matchbrackets.js"></script>
    <script src="/code_editor/addon/edit/closebrackets.js"></script>
    <script src="/code_editor/mode/clike/clike.js"></script>
  </head>
  <body>
    <h3>请在以下框格内输入您的C#代码（注：必要的系统调用已给出，请勿擅自删除！）</h3>
    <form method="post" action="#">
      {{ csrf_field() }}

      <textarea id="csharp_editor" maxlength="6000"></textarea>
      <button class="btn btn-sm btn-success" disabled="disabled">提交</button>
    </form>
    <div id="debug-error" style="width: 100%; height: 20%; background-color:#FF0000">

    </div>
    <div id="exercise-score" style="width: 100%; height: 20%; background-color:#F8F8FF">
      <span>本次练习得分: </span>
      <div id="score-photo" style="display:inline-block"></div>
      <span id="score">80</span>
    </div>
    <script src="/code_editor/score/jquery.min.js"></script>
    <script src="/code_editor/score/jquery.raty.min.js"></script>
    <script src="/code_editor/score/exercise.js"></script>
  </body>
</html>

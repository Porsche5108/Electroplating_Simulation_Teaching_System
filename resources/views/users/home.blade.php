@extends('layouts.default')
@section('title', '主页')

@section('content')
<div class="top">
  <div class="col-md-11">
    <div class="btn-group btn-group-justified" role="group" aria-label="Justified button group">
      <div class="btn-group" role="group">
      <button type="button" class="btn btn-default" id="myButton" data-loading-text=" 加载中..." autocomplete="off">初始化</button>

      </div>
      <div class="btn-group" role="group">
        <button type="button" class="btn btn-default">开始电镀</button>
      </div>
      <div class="btn-group" role="group">
        <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">添加镀件</button>
        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Modal title</h4>
              </div>
              <div class="modal-body">
                ...
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="btn-group" role="group">
        <button type="button" class="btn btn-default">导出结果</button>
      </div>
      <div class="btn-group" role="group">
        <button type="button" class="btn btn-default">从默认文件添加产品</button>
      </div>
      <div class="btn-group" role="group">
        <button type="button" class="btn btn-default">显示仿真</button>
      </div>
    </div>
  </div>
  <div class="time-counter col-md-1">

  </div>
</div>
<div class="middle">
  <div class="middle-left col-md-2"></div>
  <div class="middle-center col-md-8"></div>
  <div class="middle-right col-md-2"></div>
</div>
<div class="bottom"></div>
@stop

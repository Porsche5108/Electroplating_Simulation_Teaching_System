@extends('layouts.default')
@section('title', '主页')

@section('content')
<div class="top col-md-12">
  <div class="btn-menu col-md-9">
  <!--  <div class="btn-group btn-group-justified" role="group" aria-label="Justified button group"> -->
      <div class="btn-group" role="group">
        <button type="button" class="main-btn btn active-btn" id="initial-plating"  autocomplete="off">
          <img src="/images/initial.png" alt="initial" />
          <span>初始化</span>
        </button>
      </div>
      <div class="btn-group" role="group">
        <button id="start-plating" type="button" class="main-btn btn disabled-first" disabled="disabled">
          <img src="/images/start.png" alt="start" />
          <span>开始电镀</span>
        </button>
      </div>
      <div class="btn-group" role="group">
        <button id="add-pd-btn" type="button" class="main-btn btn btn-lg disabled-first" data-toggle="modal" data-target="#myModal" disabled="disabled">
          <img src="/images/add.png" alt="add" />
          <span>添加镀件</span>
        </button>
        <!-- Modal -->
        @include('users._modal')
        <!-- Modal -->
      <div class="btn-group" role="group">
        <button type="button" class="main-btn btn disabled-first" disabled="disabled">
          <img src="/images/result.png" alt="result" />
          <span>导出结果</span>
        </button>
      </div>
      <div class="btn-group" role="group">
        <button type="button" class="main-btn btn disabled-first" disabled="disabled">
          <img src="/images/default.png" alt="default" />
          <span>从默认文件</span>
          <span>添加产品</span>
        </button>
      </div>
      <div class="btn-group" role="group">
        <button id="show-or-hide-emulate" type="button" class="main-btn btn active-btn">
          <img src="/images/emulate.png" alt="emulate" />
          <span>显示仿真</span>
        </button>
      </div>
    <!--</div>-->
  </div>
  <div class="time-counter col-md-3">
    @include('users._timer')
  </div>
</div>
<div class="middle col-md-12">
  <div class="middle-left col-md-3 table-style">
      <table>
        <caption>产品生产列表</caption>
        <thead>
          <tr>
            <th>序号</th>
            <th>产品名称</th>
            <th>完成状态</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
  </div>
  <div class="middle-center col-md-7">
<!--
    <div id="plating-animation">
      @include('users._groove')
    </div>
-->
    <div id="plating-animation" class="template hidden-div">
      @include("users._animation")
    </div>
  </div>
  <div class="middle-right col-md-2">
      <label>行车指令</label>
  </div>
</div>
<div class="bottom table-style col-md-12">
  <table>
    <caption>产品电镀过程</caption>
    <thead>
      <tr>
        <th>序号</th>
        <th>槽号</th>
        <th>优先级</th>
        <th>滴水时间</th>
        <th>电镀下限</th>
        <th>电镀上限</th>
        <th>电镀时间</th>
      </tr>
    </thead>
  </table>
</div>
@stop

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button id="close-btn" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">导入产品</h4>
      </div>
        <div class="modal-body">
            <div id="product-info">
              <div class="col-md-9">
                <label for="product-name">产品名称：</label>
                <input id="product-name" type="text" name="product-name"><strong class="pd-err">  请输入产品名称</strong><strong class="pd-err">  产品已存在，请重新输入！</strong>
                <br /><br />
                <label for="product-number">产品数量：</label>
                <input id="product-number"  type="number" name="product-number"><strong class="pd-err">  请输入正确的产品数量</strong>
                <br /><br />
                <label for="product-type">产品种类：</label>
                <input id="product-type" type="text"><strong class="pd-err">  请输入产品类型</strong>
              </div>
              <div id="product-img" class="col-md-3">
                <input type="file">
              </div>
            </div>
            <div id="product-procedure">
              <div id="table-desc">
                <table>
                  <thead>
                    <tr>
                      <th class="percent-10">步骤</th>
                      <th class="percent-10">槽号</th>
                      <th class="width-188">滴水时间(单位：秒)</th>
                      <th class="width-188">滴水时间下限(单位：秒)</th>
                      <th class="width-188">滴水时间上限(单位：秒)</th>
                    </tr>
                  </thead>
                </table>
              </div>
              <div id="table-body">
                <table>
                  <tbody>
                    <tr>
                      <td class="percent-10">1</td>
                      <td class="percent-10">101</td>
                      <td class="width-188"><input type="number"></td>
                      <td class="width-188"><input type="number"></td>
                      <td class="width-188"><input type="number"></td>
                    </tr>
                    @for($i = 2; $i <= 48; $i++)
                      <tr>
                        <td class="percent-10">{{ $i }}</td>
                        <td class="percent-10">{{ $i+102 }}</td>
                        @for($j = 0; $j <= 2; $j++)
                          <td class="width-188"><input type="number"></td>
                        @endfor
                      </tr>
                    @endfor
                  </tbody>
                </table>
              </div>
            </div>
        </div>
      <div class="modal-footer">
        <button id="modal-close-btn" type="button" data-dismiss="modal" class="btn btn-default">关闭</button>
        <button id="pd-save-btn" type="submit"  class="btn btn-primary">保存</button>
      </div>
    </div>
  </div>
</div>
</div>

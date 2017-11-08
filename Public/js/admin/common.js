/**
 * Created by lijianwu on 2017/9/5.
 */


//添加
$('#button-add').click(function () {

    var url = SCOPE.add_url;
    window.location.href = url;
});

$('#cms-button-submit').click(function () {
    var dataArray = $('#cms-form').serializeArray()
//    遍历数组
//     alert("1234");
    var data = {};
    $.each(dataArray,function () {
        data[this.name] = this.value;
    });

    $.post(SCOPE.save_url,data,function (res) {
        if(res.status == 1)
        {
           return dialog.success(res.message,SCOPE.jump_url);
        }
        if(res.status == 0)
        {
            return dialog.error(res.message);
        }
    },'json');
});

//删除

$('.cms-table #cms-delete').click(function () {

//    改变status的值
    var id = $(this).attr('attr-id');
    var data = {
        'status':-1,
        'id':id,
    }
    layer.open({
        title : '提示',
        icon : 3,
        btn:['yes','no'],
        content:'确认删除',
        yes :function () {
            toDelete(data);
        }
        
    })

});

function toDelete(data) {
$.post(SCOPE.delete_url,data,function (res) {

    if(res.status == 1)
    {
        return dialog.success(res.message,SCOPE.jump_url);
    }
    if(res.status ==0)
    {
        return dialog.error(res.message);
    }

},'json');
}


//更新修改后的数据

$('.cms-table #cms-edit').click(function () {

    alert("1234");
    var id = $(this).attr('attr-id');

    window.location.href=SCOPE.edit_url+'&id='+id;
});
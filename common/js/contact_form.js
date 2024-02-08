
$(document).ready(function(){

    // 延長ケーブル：本数が入力されれば「必要」にチェック
    $("input[name='extend_cable_num']").keyup(function() {
        if ($(this).val() != "") {
            $("input[name='extend_cable']").val(['1']);
        }
    });
    // 延長ケーブル長さ：その他が入力されれば「その他」にチェック
    $("input[name='extend_length_other']").keyup(function() {
        if ($(this).val() != "") {
            $("input[name='extend_length[]'][value=9]").attr("checked",true);
        }
    });

    // 「同意する」にチェックされていればフォーム送信
    $("form#form1").submit(function() {
        return $("input[name='agree']").is(':checked');
    });

    // フォーム送信ボタンの色を管理
    if ( $("form#form1 input[name='agree']").is(':checked') ) {
        $("input[type='submit']").parent("p")
            .addClass("contactSend02");
    }
    $("form#form1 input[name='agree']").change(function() {
        $("input[type='submit']").parent("p")
            .toggleClass("contactSend02");
    });
});

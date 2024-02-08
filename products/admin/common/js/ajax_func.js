    $(document).ready(function() 
    {
        /**
         * Ajax通信メソッド
         * @param type      : HTTP通信の種類
         * @param url       : リクエスト送信先のURL
         * @param dataType  : データの種類
         */
        $.ajax({
        
            type: "POST",
            url: "json.php?id=",
            dataType: "json",
            /**
             * Ajax通信が成功した場合に呼び出されるメソッド
             */
            success: function(data, dataType) 
            {
                //結果が0件の場合
                if(data == null){
                	 return;
                }
                                 
                //返ってきたデータの表示
                var $content = $('#content');
                //var $middle_category_id = $('#middle_category_id');
                for (var i =0; i<data.length; i++) 
                {
                    //$content.append("<li>" + data[i].middle_category_name + "</li>");
                    $middle_category_id.append("<option>" + data[i].middle_category_name + "</option>");
                }
            },
            /**
             * Ajax通信が失敗場合に呼び出されるメソッド
             */
            error: function(XMLHttpRequest, textStatus, errorThrown) 
            {
                //通常はここでtextStatusやerrorThrownの値を見て処理を切り分けるか、単純に通信に失敗した際の処理を記述。
 
                //this;
                //thisは他のコールバック関数同様にAJAX通信時のオプションを示す。
 
                //エラーメッセージの表示
                //alert('Error : ' + errorThrown);
            }
        });
    });

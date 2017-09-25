$.ajax({
url: "http://localhost/api/question/execute",
type: "POST",
data: fd,
dataType: "json",
processData : false,
contentType : false
}).success(function(status) {  //通信成功の場合
  console.log("statusのjson変換前 : " + status);  //テスト用
  console.log("statusのjson変換後"+JSON.stringify(status));

}).error(function() {// 通信失敗時の処理
    console.log("通信 error");
}).complete(function(xhr, status) {// 通信完了時の処理
    console.log("fin");
});
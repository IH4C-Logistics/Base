function fetchData() {
  $.ajax({
      url: './db/fetch_reserve_no.php', // データを取得するサーバーサイドのスクリプト
      method: 'GET',
      dataType: 'json',
      success: function(data) {
          var table = '<table>';
          if (data.length > 0) {
              table += '<tr>';
              for (var key in data[0]) {
                  var header;
                  switch (key) {
                    case 'contract_num':
                      header = '受付番号';
                      break;
                    case 'b_name':
                      header = '会社名';
                      break;
                    case 'arrival_point':
                      header = '着地';
                      break;
                    case 'a_date':
                      header = '着日付';
                      break;
                    case 'a_time':
                      header = '着時間';
                      break;
                    case 'trans_comp':
                      header = '運搬会社';
                      break;
                    case 'driver_name':
                      header = 'ドライバー名';
                      break;                      
                    case 'tel_num':
                      header = '電話番号';
                      break;
                    case 'car_num':
                      header = '車番';
                      break;                
                    case 'vehicle_size':
                      header = '車格';
                      break;
                    case 'product_name':
                      header = '名義/メーカ名/品名等';
                      break;  
                    case 'case':
                      header = '数量(ケース数)';
                      break;
                    case 'status':
                      header = '受付状況';
                      break;                                              
                    default:
                      header = key;
                      break;
                  }
                  table += '<th>' + header + '</th>';
              }
              table += '</tr>';

              data.forEach(function(row) {
                  table += '<tr>';
                  for (var key in row) {
                      table += '<td>' + row[key] + '</td>';
                  }
                  table += '</tr>';
              });
          } else {
              table += '<tr><td>データがありません。</td></tr>';
          }
          table += '</table>';

          $('#reservationContainer').html(table);
      },
      error: function(error) {
          console.error('データの取得に失敗しました', error);
      }
  });
}

// ページが読み込まれたときにデータを取得
$(document).ready(function() {
  fetchData(); // 初回データ取得

  // 5秒ごとにデータを更新
  setInterval(fetchData, 5000);
});

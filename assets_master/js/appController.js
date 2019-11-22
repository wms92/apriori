var app = angular.module('myApp', []);
app.controller('myCtrl', function($scope,$timeout,$http) {
  $scope.data_barang = list_barang;
  console.log($scope.data_barang);
  $scope.pos = {'hitung':{},'list_pos':[],'alert':'',harga_total:0};
  $scope.dataApriori = [];
  $scope.data_idBarang = '';
  $scope.addCart = function(barang){

      let index = $scope.pos.list_pos.findIndex( record => record.menu_code === barang.menu_code );
      if (index == -1) {
        var data = angular.copy(barang);
        data.qty = 1;
        $scope.pos.list_pos.push(data);
      }else{
        $scope.pos.list_pos[index].qty++;
      }
      $scope.getApriori();
      $scope.hitungJumlah();
  }
  $scope.removePos = function(idx){
  	$scope.pos.list_pos.splice(idx,1);
    $scope.getApriori();
  	$scope.hitungJumlah();
  }

  $scope.getApriori = function()
  {
    var data_id = '';
    angular.forEach($scope.pos.list_pos,function(v,k){
        if (k!= '') {
            data_id+='-';
        }
        console.log(v);
        data_id+=v.menu_code;
    })
    $scope.data_idBarang = data_id;
    // console.log(data_id);
    if (data_id == '') {
      $scope.dataApriori = [];
    }else{
      $http({
        method: 'GET',
        url: base_url+'admin/pos/getApriori/'+data_id
      }).then(function successCallback(response) {
          console.log(response);
          $scope.dataApriori = response.data;
      }, function errorCallback(response) {
      }); 
    }
  }

  $scope.hitungJumlah = function()
  {
  	var jumlah = 0;
  	$scope.pos.list_pos.forEach(function(v,k){
      if (v.qty == '' || v.qty < 0) {
        v.qty = 0;
      }
  		jumlah += (v.qty*v.produk_harga);
  	})
  	$scope.pos.harga_total = jumlah;
  }

  $scope.alert = function(msg){
  	$scope.pos.alert = msg;
  	$timeout(function() {
  		$scope.pos.alert = '';
  	}, 2000);
  }
});
app.controller('productCtrl', function($scope,$timeout) {
  $scope.dataBahan = dataBahan;
  $scope.bahan_id = '';
  $scope.listBahan = [];
  $scope.removePos = function(idx){
    $scope.listBahan.splice(idx,1);
  }
  console.log($scope.dataBahan);
  $scope.tambahBahan = function(){
    $scope.dataBahan.forEach(function(v,k){
      if (v.bahan_id == $scope.bahan_id) {
        var newData = angular.copy(v);
        newData.jumlah_pemakaian = 0;
        $scope.listBahan.push(newData);
      }
    })
  }
});
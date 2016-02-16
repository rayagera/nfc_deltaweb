/**
 *
 * Created by zhongming on 9/1/14.
 */

var deltaController = angular.module('deltaControllers', []),
$path = "/nfc_deltaweb" ;

deltaController.controller('myProductsController', ['$scope', '$http','$routeParams',
    function ($scope, $http,$routeParams) {
       $http.post($path+'/rest.php',{type:'myProducts',pageNum:$routeParams.pageNum}).success(function (data) {
           $scope.data = data.query;
           var totalNum = parseInt(data.count.totalCount),
           base = $routeParams.pageNum%5!=0?parseInt($routeParams.pageNum/5)+1:$routeParams.pageNum/5;
           $scope.totalPage = totalNum%20!=0?parseInt(totalNum/20)+1:totalNum/20;
           var array = [];
           if($scope.totalPage<=5){
               for(var i =1;i<=$scope.totalPage;i++){
                   array[i-1] = i;
               }
           }else{
               if(base==1){
                   for(var b =1;b<=5;b++){
                       array[b-1] = b;
                   }
               }else{
                   if($scope.totalPage>base*5){
                       var i = 0;
                       for(var c = ((base-1)*5+1);c<=base*5;c++){
                           array[i] = c;
                           i++;
                       }
                   }else{
                       var i = 0;
                       for(var c = ((base-1)*5+1);c<=$scope.totalPage;c++){
                           array[i] = c;
                           i++;
                       }
                   }
               }
           }
           $scope.base = base;
           $scope.pageArray = array;
           $scope.currentNum = parseInt($routeParams.pageNum);
       });
        $(".nav-sidebar li").removeClass('active').find('a[href="#/myProducts/1"]').parent().addClass('active');
    }]);

deltaController.controller('userManagementController', ['$scope', '$http','$routeParams',
    function ($scope, $http,$routeParams) {
        $http.post($path+'/rest.php',{type:'userList',pageNum:$routeParams.pageNum}).success(function (data) {
            $scope.data = data.query;
            var totalNum = parseInt(data.count.totalCount),
                base = $routeParams.pageNum%5!=0?parseInt($routeParams.pageNum/5)+1:$routeParams.pageNum/5;
            $scope.totalPage = totalNum%20!=0?parseInt(totalNum/20)+1:totalNum/20;
            var array = [];
            if($scope.totalPage<=5){
                for(var i =1;i<=$scope.totalPage;i++){
                    array[i-1] = i;
                }
            }else{
                if(base==1){
                    for(var b =1;b<=5;b++){
                        array[b-1] = b;
                    }
                }else{
                    if($scope.totalPage>base*5){
                        var i = 0;
                        for(var c = ((base-1)*5+1);c<=base*5;c++){
                            array[i] = c;
                            i++;
                        }
                    }else{
                        var i = 0;
                        for(var c = ((base-1)*5+1);c<=$scope.totalPage;c++){
                            array[i] = c;
                            i++;
                        }
                    }
                }
            }
            $scope.base = base;
            $scope.pageArray = array;
            $scope.currentNum = parseInt($routeParams.pageNum);
        });
        $(".nav-sidebar li").removeClass('active').find('a[href="#/userManagement/1"]').parent().addClass('active');
    }]);

deltaController.controller('productsManagementController', ['$scope', '$http','$routeParams',
    function ($scope, $http,$routeParams) {
        $http.post($path+'/rest.php',{type:'productsList',pageNum:$routeParams.pageNum}).success(function (data) {
            $scope.data = data.query;
            var totalNum = parseInt(data.count.totalCount),
                base = $routeParams.pageNum%5!=0?parseInt($routeParams.pageNum/5)+1:$routeParams.pageNum/5;
            $scope.totalPage = totalNum%20!=0?parseInt(totalNum/20)+1:totalNum/20;
            var array = [];
            if($scope.totalPage<=5){
                for(var i =1;i<=$scope.totalPage;i++){
                    array[i-1] = i;
                }
            }else{
                if(base==1){
                    for(var b =1;b<=5;b++){
                        array[b-1] = b;
                    }
                }else{
                    if($scope.totalPage>base*5){
                        var i = 0;
                        for(var c = ((base-1)*5+1);c<=base*5;c++){
                            array[i] = c;
                            i++;
                        }
                    }else{
                        var i = 0;
                        for(var c = ((base-1)*5+1);c<=$scope.totalPage;c++){
                            array[i] = c;
                            i++;
                        }
                    }
                }
            }
            $scope.base = base;
            $scope.pageArray = array;
            $scope.currentNum = parseInt($routeParams.pageNum);
        });
        $(".nav-sidebar li").removeClass('active').find('a[href="#/productsManagement/1"]').parent().addClass('active');
    }]);

deltaController.controller('apkManagementController', ['$scope', '$http','$routeParams',
    function ($scope, $http,$routeParams) {
      
        $http.post($path+'/rest.php',{type:'productsList',pageNum:$routeParams.pageNum}).success(function (data) {
            $scope.data = data.query;
            var totalNum = parseInt(data.count.totalCount),
                base = $routeParams.pageNum%5!=0?parseInt($routeParams.pageNum/5)+1:$routeParams.pageNum/5;
            $scope.totalPage = totalNum%20!=0?parseInt(totalNum/20)+1:totalNum/20;
            var array = [];
            if($scope.totalPage<=5){
                for(var i =1;i<=$scope.totalPage;i++){
                    array[i-1] = i;
                }
            }else{
                if(base==1){
                    for(var b =1;b<=5;b++){
                        array[b-1] = b;
                    }
                }else{
                    if($scope.totalPage>base*5){
                        var i = 0;
                        for(var c = ((base-1)*5+1);c<=base*5;c++){
                            array[i] = c;
                            i++;
                        }
                    }else{
                        var i = 0;
                        for(var c = ((base-1)*5+1);c<=$scope.totalPage;c++){
                            array[i] = c;
                            i++;
                        }
                    }
                }
            }
          
            $scope.data = [{"id":"1","version":"1.1","platform":"IOS","date":"2015/01/01","url":"www.baidu.com","counter":"0"},
                           {"id":"2","version":"1.2","platform":"IOS","date":"2015/02/01","url":"www.baidu.com","counter":"0"},
                           {"id":"2","version":"1.1","platform":"Android","date":"2015/02/01","url":"www.baidu.com","counter":"1"},
                           {"id":"2","version":"1.2","platform":"Android","date":"2015/02/01","url":"www.baidu.com","counter":"1"},
                           {"id":"2","version":"1.3","platform":"Android","date":"2015/02/01","url":"www.baidu.com","counter":"1"}
                          ];
            $scope.base = base;
            $scope.pageArray = array;
            $scope.currentNum = parseInt($routeParams.pageNum);
        });
        $(".nav-sidebar li").removeClass('active').find('a[href="#/apkManagement/1"]').parent().addClass('active');
    }]);

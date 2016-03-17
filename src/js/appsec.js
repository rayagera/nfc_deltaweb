
var deltaPlus = angular.module('deltaAppSec',[]);
var $path = "/nfc_deltaweb" ;

    deltaPlus.controller('myCtrl',['$scope', '$http',function($scope, $http){
        $scope.invalideAccount = false;
        $scope.secCode = '';

        $scope.error = false;
        $scope.incomplete = false; 

        $scope.findAccount = function(){
            var account = ( $scope.name ); 
            $http.post($path +'/restp.php',{type:'findAccount',email:account}).success(function (data) {
                        if(data && data[0]){
                            //alert(data[0]);
                            console.log(data[0].login);
                            console.log(data[0].email);
                            $scope.invalideAccount = false;
                            $scope.login=data[0].login;
                            $scope.email=data[0].email;
                            document.getElementById('myForm').submit();
                        } else {
                            console.log('no data found');
                            $scope.invalideAccount = true;
                        }
                       //$scope.data = data;
                        //alert(data);
                    });

            return false;
            /*$http.post($path+'/rest.php',{type:'myProducts',pageNum:1}).success(function (data) {
                $scope.data = data.query;
                console.log(data);
            });*/
        }

        $scope.sendCode = function(){
            var account = ( $scope.name ); 
            //alert("email sending ....");
            $http.post($path +'/sendmail.php',{type:'sendCode'}).success(function (data) {
                        $scope.secCode = data;
                        alert(data);
                    });
        }

        $scope.password = '';
        $scope.password2 = '';

        $scope.$watch('password',function() {$scope.test();});
        $scope.$watch('password2',function() {$scope.test();});


        $scope.test = function() {
              if ($scope.password !== $scope.password2) {
                $scope.error = true;
              } else {
                $scope.error = false;
              }
              $scope.incomplete = false;
              if (!$scope.password.length || !$scope.password2.length || $scope.password.length<6) {
                 $scope.incomplete = true;
              }
        };


    }]);


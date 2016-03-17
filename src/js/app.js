/**
 * Created by zhongming on 9/1/14.
 */

var deltaPlus = angular.module('deltaApp',['ngRoute','deltaControllers'])
deltaPlus.config(['$routeProvider',function($routeProvider){
    $routeProvider.when('/myProducts/:pageNum',{
        templateUrl:'template/myProductsList.html',
        controller:'myProductsController'
    }).when('/userManagement/:pageNum',{
        templateUrl:'template/userManagementList.html',
        controller:'userManagementController'
    }).when('/productsManagement/:pageNum',{
        templateUrl:'template/productsManagementList.html',
        controller:'productsManagementController'
    }).when('/apkManagement/:pageNum',{
        templateUrl:'template/apkManagementList.html',
        controller:'apkManagementController'
    }).otherwise({
        redirectTo:'/myProducts/1'
    });

}]);

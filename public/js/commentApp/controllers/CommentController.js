/**
 * Created by bishal on 5/1/17.
 */
angular.module('CommentController', [])
    .controller('CommentController', function($scope, $http, $uibModal, $rootScope, Comment) {
        $scope.comments = {};
        var $ctrl = this;

        Comment.get()
            .then(function successCallback(response) {
                $scope.comments = response.data;
            }, function errorCallback(response) {
                alert("ERROR: Error on server!");
            });

        $scope.submitComment = function ($postId) {
            Comment.save($scope.comments[$postId], $postId);
        };

        $scope.open = function (commentId) {
            var modalInstance = $uibModal.open({
                templateUrl: 'form.html',
                controller: 'ModalInstanceCtrl',
                controllerAs: '$ctrl',
                scope:$scope,
                resolve: {
                    commentId: function(){
                        return commentId;
                    }
                }
            });
        };
    });

angular.module('CommentController').controller('ModalInstanceCtrl', function ($scope, $uibModalInstance, Comment, commentId) {
    var $ctrl = this;
    $ctrl.comment = "";
    $ctrl.author = "";

    $ctrl.submit = function () {
        $uibModalInstance.close();
        var commentData = {comment:$ctrl.comment, author:$ctrl.author, parent: commentId};
        Comment.save(commentData)
            .then(function successCallback(response) {
                var comment = response.data.comment;
                putIntoRightPlace($scope.comments, comment);
            }, function errorCallback(response) {
                alert("ERROR: Error on saving Comment!");
            });
    };

    function putIntoRightPlace(comments, comment){
        if(comment.comment_id == null){
            comments.push(comment);
            return;
        }
        recursivelyFindAndPlaceComment(comments, comment);
    }

    function recursivelyFindAndPlaceComment(comments, comment){
        comments.forEach(function(possiblyParentComment){
            if(possiblyParentComment.id == comment.comment_id){
                if(possiblyParentComment.comments == undefined){
                    possiblyParentComment.comments = [];
                }
                possiblyParentComment.comments.push(comment);
                return true;
            }
            if(possiblyParentComment.comments){
                if(putIntoRightPlace(possiblyParentComment.comments, comment)){
                    return true;
                }
            }
        });
    }

    $ctrl.cancel = function () {
        $uibModalInstance.dismiss('cancel');
    };
})/*.directive('collection', function () {
        return {
            restrict: "E",
            replace: true,
            scope: {
                collection: '='
            },
            templateUrl: 'collectionTemplate.html',
            // template: "<ul><member ng-repeat='member in collection' member='member'></member></ul>"
        }
    }).directive('member', function ($compile) {
        return {
            restrict: "E",
            replace: true,
            scope: {
                member: '='
            },
            // template: "<li>{{member.author}}</li>",
            templateUrl: 'InnerCommentTemplate.html',
            link: function (scope, element, attrs) {
                if (angular.isArray(scope.member.comments)) {
                    element.append("<collection collection='member.comments'></collection>");
                    $compile(element.contents())(scope)
                }
            }
        }
    })*/;

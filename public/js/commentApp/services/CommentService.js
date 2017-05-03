/**
 * Created by bishal on 5/2/17.
 */
angular.module('CommentService', [])
    .factory('Comment', function($http) {
        return {

            get : function() {
                return $http.get('/api/comments');
            },

            save: function(comment){
                var commentData = {comment: comment.comment, author: comment.author};
                if(comment.parent != undefined){
                    commentData.parent = comment.parent;
                }
                return $http({
                    method: "POST",
                    url: "/api/comments",
                    data: commentData
                });
            }
        }
    });
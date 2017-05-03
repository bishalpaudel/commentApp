@extends('layouts.frontend')

@section('content')
        <div ng-app="commentApp" ng-controller="CommentController as $ctrl">
            <button class="btn btn-default" ng-click="open()">Add Comment</button>
            <hr>

            <ul class="media-list">
                <collection collection='comments'></collection>

                <div class="media col-lg-12 pull-right" ng-repeat="commentLayer1 in comments">
                    <div class="media-left">
                        <a href="#"><img alt="64x64" class="media-object" src="http://lorempixel.com/64/64" style="width: 64px; height: 64px;"></a>
                    </div>
                    <div class="media-body">
                        <small>by</small> @{{commentLayer1.author}} <small>at</small> @{{ commentLayer1.created_at }}
                        <div>
                        @{{ commentLayer1.comment }}
                        </div>
                        <button class="btn btn-default" ng-click="open(commentLayer1.id)">Add Comment</button>

                        <div class="media col-lg-12 pull-right" ng-repeat="commentLayer2 in commentLayer1.comments">
                            <div class="media-left">
                                <a href="#"><img alt="64x64" class="media-object" src="http://lorempixel.com/64/64" style="width: 64px; height: 64px;"></a>
                            </div>
                            <div class="media-body">
                                <small>by</small> @{{commentLayer2.author}} <small>at</small> @{{ commentLayer2.created_at }}
                                <div>
                                    @{{ commentLayer2.comment }}
                                </div>
                                <button class="btn btn-default" ng-click="open(commentLayer2.id)">Add Comment</button>

                                <div class="media col-lg-12 pull-right" ng-repeat="commentLayer3 in commentLayer2.comments">
                                    <div class="media-left">
                                        <a href="#"><img alt="64x64" class="media-object" src="http://lorempixel.com/64/64" style="width: 64px; height: 64px;"></a>
                                    </div>
                                    <div class="media-body">
                                        <small>by</small> @{{commentLayer3.author}} <small>at</small> @{{ commentLayer3.created_at }}
                                        <div>
                                            @{{ commentLayer3.comment }}
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </ul>
            <script type="text/ng-template" id="form.html">
                <div class="popover-content">
                    <div class="well">
                        <h4>Leave a Comment:</h4>
                        <form>
                            <div class="form-group">
                                <input type="text" ng-model="$ctrl.author">
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" rows="3" ng-model="$ctrl.comment"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary" ng-click="$ctrl.submit()">Submit</button>
                            <button class="btn btn-warning" type="button" ng-click="$ctrl.cancel()">Cancel</button>
                        </form>
                    </div>
                </div>
            </script>

            {{--<script type="text/ng-template" id="collectionTemplate.html">--}}
                {{--<member ng-repeat='member in collection' member='member'></member>--}}
            {{--</script>--}}

            {{--<script type="text/ng-template" id="InnerCommentTemplate.html">--}}
                {{--<div class="media col-lg-12 pull-right">--}}
                    {{--<div class="media-left">--}}
                        {{--<a href="#"><img alt="64x64" class="media-object" src="http://lorempixel.com/64/64" style="width: 64px; height: 64px;"></a>--}}
                    {{--</div>--}}
                    {{--<div class="media-body">--}}
                        {{--<small>by</small> @{{member.author}} <small>at</small> @{{ member.created_at }}--}}
                        {{--<div>--}}
                            {{--@{{ member.comment }}--}}
                        {{--</div>--}}
                        {{--<button class="btn btn-default" ng-click="open(member.id)">Add Comment</button>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</script>--}}

        </div>
@endsection
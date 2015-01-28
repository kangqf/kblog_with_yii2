<?php
use frontend\assets\TestAsset;
TestAsset::register($this);
?>

<!DOCTYPE html>
<html>
<head>
    <title>屏幕分享</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

    <script src="https://kangqingfei.cn/js/webRTC/firebase.js"></script>
    <script src="https://kangqingfei.cn/js/webRTC/RTCMultiConnection.js"></script>


</head>


<body>
 <!-- just copy this <section> and next script -->
            <section class="experiment">
                <br><br><br>
                <input type="text" id="broadcast-name">
                <button id="setup-new-broadcast" class="setup">分享你的屏幕</button>
                <br><br>
                <section>
                    <span>

                        <a href="" target="_blank" title="点击这里你的分享将是私有的">
                            私有分享 点击这里
                            <code>
                                <strong id="unique-token">#123456789</strong>
                            </code>
                        </a>
                    </span>
                </section>
                
                <!-- list of all available broadcasting rooms -->
                <table style="width: 100%;" id="rooms-list"></table>
                
                <!-- local/remote videos container -->
                <div id="videos-container"></div>
            </section>
        
            <script>
                // Muaz Khan     - https://github.com/muaz-khan
                // MIT License   - https://www.webrtc-experiment.com/licence/
                // Documentation - https://github.com/muaz-khan/WebRTC-Experiment/tree/master/RTCMultiConnection

                var connection = new RTCMultiConnection();
                
                // connection.trickleIce = false;
                
                // this code is used for screen-viewers only.
                // screen sender will be overriding it later.
                connection.sdpConstraints.mandatory = {
                    OfferToReceiveAudio: false,
                    OfferToReceiveVideo: true
                };
                
                connection.session = {
                    screen: true,
                    oneway: true
                };

                connection.onstream = function(e) {
                    e.mediaElement.width = 600;
                    videosContainer.insertBefore(e.mediaElement, videosContainer.firstChild);
                    rotateVideo(e.mediaElement);
                    scaleVideos();
                };

                function rotateVideo(mediaElement) {
                    mediaElement.style[navigator.mozGetUserMedia ? 'transform' : '-webkit-transform'] = 'rotate(0deg)';
                    setTimeout(function() {
                        mediaElement.style[navigator.mozGetUserMedia ? 'transform' : '-webkit-transform'] = 'rotate(360deg)';
                    }, 1000);
                }

                connection.onstreamended = function(e) {
                    e.mediaElement.style.opacity = 0;
                    rotateVideo(e.mediaElement);
                    setTimeout(function() {
                        if (e.mediaElement.parentNode) {
                            e.mediaElement.parentNode.removeChild(e.mediaElement);
                        }
                        scaleVideos();
                    }, 1000);
                };

                var sessions = { };
                connection.onNewSession = function(session) {
                    if (sessions[session.sessionid]) return;
                    sessions[session.sessionid] = session;

                    var tr = document.createElement('tr');
                    tr.innerHTML = '<td><strong>' + session.extra['session-name'] + '</strong> 正在分享他的屏幕</td>' +
                        '<td><button class="join">查看他的屏幕</button></td>';
                    roomsList.insertBefore(tr, roomsList.firstChild);

                    var joinRoomButton = tr.querySelector('.join');
                    joinRoomButton.setAttribute('data-sessionid', session.sessionid);
                    joinRoomButton.onclick = function() {
                        this.disabled = true;

                        var sessionid = this.getAttribute('data-sessionid');
                        session = sessions[sessionid];

                        if (!session) throw 'No such session exists.';

                        session.join();
                    };
                };

                var videosContainer = document.getElementById('videos-container') || document.body;
                var roomsList = document.getElementById('rooms-list');

                document.getElementById('setup-new-broadcast').onclick = function() {
                    this.disabled = true;
                    connection.extra = {
                        'session-name': document.getElementById('broadcast-name').value || 'Anonymous'
                    };
                    
                    // screen sender don't need to receive any media.
                    // so both media-lines must be "sendonly".
                    connection.sdpConstraints.mandatory = {
                        OfferToReceiveAudio: false,
                        OfferToReceiveVideo: false
                    };
                    
                    connection.open();
                };

                // setup signaling to search existing sessions
                connection.connect();

                (function() {
                    var uniqueToken = document.getElementById('unique-token');
                    if (uniqueToken)
                        if (location.hash.length > 2) uniqueToken.parentNode.parentNode.parentNode.innerHTML = '<h2 style="text-align:center;"><a href="' + location.href + '" target="_blank">分享这个链接给好友</a></h2>';
                        else uniqueToken.innerHTML = uniqueToken.parentNode.parentNode.href = '#' + (Math.random() * new Date().getTime()).toString(36).toUpperCase().replace( /\./g , '-');
                })();

                function scaleVideos() {
                    var videos = document.querySelectorAll('video'),
                        length = videos.length, video;

                    var minus = 130;
                    var windowHeight = 700;
                    var windowWidth = 600;
                    var windowAspectRatio = windowWidth / windowHeight;
                    var videoAspectRatio = 4 / 3;
                    var blockAspectRatio;
                    var tempVideoWidth = 0;
                    var maxVideoWidth = 0;

                    for (var i = length; i > 0; i--) {
                        blockAspectRatio = i * videoAspectRatio / Math.ceil(length / i);
                        if (blockAspectRatio <= windowAspectRatio) {
                            tempVideoWidth = videoAspectRatio * windowHeight / Math.ceil(length / i);
                        } else {
                            tempVideoWidth = windowWidth / i;
                        }
                        if (tempVideoWidth > maxVideoWidth)
                            maxVideoWidth = tempVideoWidth;
                    }
                    for (var i = 0; i < length; i++) {
                        video = videos[i];
                        if (video)
                            video.width = maxVideoWidth - minus;
                    }
                }

                window.onresize = scaleVideos;
            </script>

</body>
</html>
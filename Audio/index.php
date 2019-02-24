<script>window.demoVersion = '2017.08.31';</script>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>WebRTC Audio Recording using MediaStreamRecorder</title>

    <script src="https://cdn.WebRTC-Experiment.com/MediaStreamRecorder.js"></script>
    
	<!-- <script src="https://webrtc.github.io/adapter/adapter-latest.js"></script> -->

    <link rel="stylesheet" href="https://cdn.webrtc-experiment.com/style.css">  

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="author" content="Muaz Khan">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <style>
        input {
            border: 1px solid rgb(46, 189, 235);
            border-radius: 3px;
            font-size: 1em;
            outline: none;
            padding: .2em .4em;
            width: 60px;
            text-align: center;
        }
        select {
            vertical-align: middle;
            line-height: 1;
            padding: 2px 5px;
            height: auto;
            font-size: inherit;
            margin: 0;
        }
    </style>
</head>

<body>
    <article>
        <section class="experiment" style="padding: 5px;">
		
           <!-- <label for="time-interval">Time Interval (milliseconds):</label> -->
            <input type="hidden" id="time-interval" value="5000">
            
            <input id="left-channel" type="checkbox" checked style="width:auto; display:none;">
            <!-- <label for="left-channel">Record Mono Audio if WebAudio API is selected (above)</label> -->
            <button id="start-recording">Start</button>
            <button id="stop-recording" disabled>Stop</button>

            <button id="pause-recording" disabled>Pause</button>
            <button id="resume-recording" disabled>Resume</button>

            <button id="save-recording" disabled>Save</button>
        </section>

        <section class="experiment">
            <div id="audios-container"></div>
        </section>
        <br>
<span id="autioFile"></span>
        <script>
            function captureUserMedia(mediaConstraints, successCallback, errorCallback) {
                navigator.mediaDevices.getUserMedia(mediaConstraints).then(successCallback).catch(errorCallback);
            }
            var mediaConstraints = {
                audio: true
            };
            document.querySelector('#start-recording').onclick = function() {
                this.disabled = true;
                captureUserMedia(mediaConstraints, onMediaSuccess, onMediaError);
            };
            document.querySelector('#stop-recording').onclick = function() {
                this.disabled = true;
                mediaRecorder.stop();
                mediaRecorder.stream.stop();
                document.querySelector('#pause-recording').disabled = true;
                document.querySelector('#start-recording').disabled = false;
            };
            document.querySelector('#pause-recording').onclick = function() {
                this.disabled = true;
                mediaRecorder.pause();
                document.querySelector('#resume-recording').disabled = false;
            };
            document.querySelector('#resume-recording').onclick = function() {
                this.disabled = true;
                mediaRecorder.resume();
                document.querySelector('#pause-recording').disabled = false;
            };
            document.querySelector('#save-recording').onclick = function() {
                this.disabled = true;
               var afile = mediaRecorder.save();

                document.getElementById('autioFile').innerHTML = afile;
                // alert('Drop WebM file on Chrome or Firefox. Both can play entire file. VLC player or other players may not work.');
            };
            var mediaRecorder;
            function onMediaSuccess(stream) {
                var audio = document.createElement('audio');
                audio = mergeProps(audio, {
                    controls: true,
                    muted: true
                });
                audio.srcObject = stream;
                audio.play();
                audiosContainer.appendChild(audio);
                audiosContainer.appendChild(document.createElement('hr'));
                mediaRecorder = new MediaStreamRecorder(stream);
                mediaRecorder.stream = stream;
				
                mediaRecorder.mimeType = 'audio/webm'; // audio/ogg or audio/wav or audio/webm
                mediaRecorder.audioChannels = !!document.getElementById('left-channel').checked ? 1 : 2;
                mediaRecorder.ondataavailable = function(blob) {
                    var a = document.createElement('a');
                    a.target = '_blank';
                    //a.innerHTML = 'Open Recorded Audio No. ' + (index++) + ' (Size: ' + bytesToSize(blob.size) + ') Time Length: ' + getTimeLength(timeInterval);
                    a.href = URL.createObjectURL(blob);
                    audiosContainer.appendChild(a);
                    //audiosContainer.appendChild(document.createElement('hr'));
                };
                var timeInterval = document.querySelector('#time-interval').value;
                if (timeInterval) timeInterval = parseInt(timeInterval);
                else timeInterval = 5 * 1000;
                // get blob after specific time interval
                mediaRecorder.start(timeInterval);
                document.querySelector('#stop-recording').disabled = false;
                document.querySelector('#pause-recording').disabled = false;
                document.querySelector('#save-recording').disabled = false;
            }
            function onMediaError(e) {
                console.error('media error', e);
            }
            var audiosContainer = document.getElementById('audios-container');
            var index = 1;
            // below function via: http://goo.gl/B3ae8c
            function bytesToSize(bytes) {
                var k = 1000;
                var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
                if (bytes === 0) return '0 Bytes';
                var i = parseInt(Math.floor(Math.log(bytes) / Math.log(k)), 10);
                return (bytes / Math.pow(k, i)).toPrecision(3) + ' ' + sizes[i];
            }
            // below function via: http://goo.gl/6QNDcI
            function getTimeLength(milliseconds) {
                var data = new Date(milliseconds);
                return data.getUTCHours() + " hours, " + data.getUTCMinutes() + " minutes and " + data.getUTCSeconds() + " second(s)";
            }
            window.onbeforeunload = function() {
                document.querySelector('#start-recording').disabled = false;
            };
        </script>

       <script src="https://cdn.webrtc-experiment.com/commits.js" async></script>
    </article>
</body>

</html>
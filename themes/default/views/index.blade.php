<!DOCTYPE html>
<html>
<head>
    <title>e8网络</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="renderer" content="webkit">
    <style type="text/css">
        body,ol,ul,h1,h2,h3,h4,h5,h6,p,th,td,dl,dd,form,fieldset,legend,input,textarea,select{margin:0;padding:0}
        body{font-family: -apple-system, "Helvetica Neue", "Arial", "PingFang SC", "Hiragino Sans GB", "Microsoft YaHei", "WenQuanYi Micro Hei", sans-serif;background:#fff;-webkit-text-size-adjust:100%;}
        a{color:#2d374b;text-decoration:none}
        a:hover{color:#cd0200;text-decoration:underline}
        em{font-style:normal}
        li{list-style:none}
        img{border:0;vertical-align:middle}
        table{border-collapse:collapse;border-spacing:0}
        p{word-wrap:break-word}
        .content{
            width: 450px;
            height: 260px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
        }
        .logo{
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin: 0 auto;
            box-shadow: rgba(0,0,0,.05) 0 0 2px 3px;
            transition: transform 800ms;
            cursor: pointer;
        }
        .logo:hover{
            transform: rotate(360deg);
        }
        .logo > img{
            width: 100%;
            height: 100%;
        }
        .nav{
            overflow: hidden;
            margin-top: 60px;
        }
        .nav li{
            float: left;
            width: 25%;
        }
        .nav a{
            text-decoration: none;
            color: #636b6f;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 1px;
            transition: color 600ms;
        }
        .nav a:hover{
            color: #C52A4C;
        }
        canvas{
            background-color: #fff;
            opacity: 1;
            transition: opacity .4s;
            position: relative;
            z-index: 9;
        }
    </style>
</head>
<body>
<div class="content">
    <div class="logo" time="10" onclick="clickLogo(this)"><img src="{!! asset('static/default/assets/logo.png') !!}"></div>
    <ul class="nav">
        <li>
            <a href="#">Blog</a>
        </li>
        <li>
            <a href="#">WeiBo</a>
        </li>
        <li>
            <a href="#">GitHub</a>
        </li>
        <li>
            <a href="#">About US</a>
        </li>
    </ul>
</div>
<script type="text/javascript" src="{!! mix('/js/phaser.js', 'static/default') !!}"></script>
<script type="text/javascript">
    var game;
    states = {};
    function clickLogo(dom){
        var time = dom.getAttribute('time');
        time --;
        dom.setAttribute('time', time)
        if(time == 0){
            game = new Phaser.Game(1366,768, Phaser.AUTO, 'game');
            game.state.add('preload', states.preload);
            game.state.add('play', states.play);

            game.state.start('preload');
        }
    }
    states.preload = function() {
        this.preload = function () {
            game.load.image('background', '{!! asset('static/default/assets/background.png') !!}');
            game.load.image('ground', '{!! asset('static/default/assets/ground.png') !!}');
            game.load.image('bird', '{!! asset('static/default/assets/bird.png') !!}');
            game.load.spritesheet('pipe', '{!! asset('static/default/assets/pipes.png') !!}', 54, 766, 2);
            game.load.bitmapFont('flappy_font', '{!! asset('static/default/assets/flappyfont.png') !!}', '{!! asset('static/default/assets/flappyfont.fnt') !!}');
            game.load.audio('fly_sound', '{!! asset('static/default/assets/flap.wav') !!}');
            game.load.audio('score_sound', '{!! asset('static/default/assets/score.wav') !!}');
            game.load.audio('hit_pipe_sound', '{!! asset('static/default/assets/pipe-hit.wav') !!}');
            game.load.audio('hit_ground_sound', '{!! asset('static/default/assets/ouch.wav') !!}');
            game.load.image('btn', '{!! asset('static/default/assets/start-button.png') !!}');
            game.load.image('game_over', '{!! asset('static/default/assets/gameover.png') !!}');
            game.load.image('score_board', '{!! asset('static/default/assets/scoreboard.png') !!}');
        }
        this.create = function() {
            game.scale.scaleMode = Phaser.ScaleManager.EXACT_FIT;
            game.scale.forcePortrait = true;
            game.scale.refresh();
            game.state.start('play');
        };
    };


    var bg,ground,bird,pipeGroup,scoreText, score = 0,soundFly,soundScore,soundHitPipe,soundHitGround,gameIsOver = false;

    states.play = function() {
        this.create = function() {
            bg = game.add.tileSprite(0, 0, game.width, game.height, 'background');
            bg.autoScroll(-30 ,0);
            pipeGroup = game.add.group();
            pipeGroup.enableBody = true;
            ground = game.add.tileSprite(0, game.height-112, game.width, 112, 'ground');
            ground.autoScroll(-200 ,0);

            scoreText = game.add.bitmapText(game.world.centerX - 20, 30, 'flappy_font', '0', 36);

            soundFly = game.add.sound('fly_sound');
            soundScore = game.add.sound('score_sound');
            soundHitPipe = game.add.sound('hit_pipe_sound');
            soundHitGround = game.add.sound('hit_ground_sound');

            game.physics.enable(ground, Phaser.Physics.ARCADE);
            ground.body.immovable = true;
            bird = game.add.sprite(200, 100, 'bird');
            bird.anchor.setTo(0.5, 0.5);
            bird.width  = 80;
            bird.height = 80;
            game.physics.enable(bird, Phaser.Physics.ARCADE);

            bird.body.bounce.y = 0.3;
            game.input.onDown.add(fly);
            game.time.events.start();
            game.time.events.loop(1500, generatePipes, this);

        }
        this.update = function(){
            game.physics.arcade.collide(bird, ground, null, null, this);
            bird.body.gravity.y = 1150;
            game.physics.arcade.collide(bird, ground, hitGround, null, this);
            game.physics.arcade.overlap(bird, pipeGroup, hitPipe, null, this);
            if(!bird.inWorld) hitCeil();
            if(bird.angle < 90) bird.angle += 2.5;
            pipeGroup.forEachExists(checkScore, this);
        }
        function fly(){
            bird.body.velocity.y = -450;
            game.add.tween(bird).to({angle: -30}, 100, null, true, 0, 0, false);
            soundFly.play();
        }
        function generatePipes() {
            var position = Math.random() * 300;

            var topPipeY = position - 680;
            var bottomPipeY = position + 266;
            if(resetPipe(topPipeY, bottomPipeY)) return;
            var topPipe = game.add.sprite(game.width, topPipeY, 'pipe', 0, pipeGroup);
            var bottomPipe = game.add.sprite(game.width, bottomPipeY, 'pipe', 1, pipeGroup);
            pipeGroup.setAll('checkWorldBounds', true);
            pipeGroup.setAll('outOfBoundsKill', true);
            pipeGroup.setAll('body.velocity.x', -200);
        }
        function resetPipe(topPipeY, bottomPipeY) {
            var i = 0;
            pipeGroup.forEachDead(function(pipe) {
                if(pipe.y <= 0) {
                    pipe.reset(game.width, topPipeY);
                    pipe.hasScored = false;
                } else {
                    pipe.reset(game.width, bottomPipeY);
                }
                pipe.body.velocity.x = -200;
                i++;
            }, this);
            return i == 2;
        }
        function checkScore(pipe){
            if(!pipe.hasScored && pipe.y <= 0 && pipe.x <= bird.x - 17 - 54) {
                pipe.hasScored = true;
                scoreText.text = ++score;
                soundScore.play();
                return true;
            }
            return false;
        }
        function hitCeil() {
            if(gameIsOver) return;
            soundHitGround.play();
            gameOver(true);
        };
        function hitPipe() {
            if(gameIsOver) return;
            soundHitPipe.play();
            gameOver(true);
        };
        function hitGround() {
            if(gameIsOver) return;
            soundHitGround.play();
            gameOver(true);
        };
        function gameOver(show_text) {
            gameIsOver = true;
            stopGame();
            if(show_text) showGameOverText();
        };
        function showGameOverText() {
            scoreText.destroy();
            game.bestScore = game.bestScore || 0;
            if(score > game.bestScore) game.bestScore = score;
            var gameOverGroup = game.add.group();
            var gameOverText = gameOverGroup.create(game.width/2, 0, 'game_over');
            var scoreboard = gameOverGroup.create(game.width/2, 70, 'score_board');
            var currentScoreText = game.add.bitmapText(game.width/2 + 60, 105, 'flappy_font', score+'', 20, gameOverGroup);
            var bestScoreText = game.add.bitmapText(game.width/2 + 60, 153, 'flappy_font', game.bestScore+'', 20,  gameOverGroup);
            var replayBtn = game.add.button(game.width/2, 210, 'btn', function() {
                game.state.start('play');
                gameIsOver = false;
                score = 0;
            }, this, null, null, null, null, gameOverGroup);
            gameOverText.anchor.setTo(0.5, 0);
            scoreboard.anchor.setTo(0.5, 0);
            replayBtn.anchor.setTo(0.5, 0);
            gameOverGroup.y = 60;
        };
        function stopGame() {
            bg.stopScroll();
            ground.stopScroll();
            pipeGroup.forEachExists(function(pipe) {
                pipe.body.velocity.x = 0;
            }, this);
            game.input.onDown.remove(fly);
            game.time.events.stop(true);

        };
    }

</script>
</body>
</html>
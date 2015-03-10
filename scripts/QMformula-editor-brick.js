var QMBrick = function (vals) {
	var xPos = vals.x;
	var yPos = vals.y;
	var ctx = vals.ctx;
	var value = vals.value;
	var type = vals.type; //Defines if it's a menu item or a moveable brick
	var controller = vals.controller;
	var width = 150;
	var height = 120;
	var description = vals.description;
	var input;
	if (vals.hasOwnProperty("input")) {
		input = vals.input;
		input.onsubmit(function () {
			newResultName();
		});
	}
	var weight = vals.weight;
	var upDownButtonHeight = 20;
	var drawBoder = false;
	var isOverUpButton = false;
	var isOverDownButton = false;
	var colorFont = "black";
	var colorBackground = "white";
	var red = new Color(232, 9, 26);
	var white = new Color(255, 255, 255);
	var green = new Color(6, 170, 60);
	var start = green;
	var end = white;

	var qmBrick = {};

	//Private:
	var drawBrick = function () {

		ctx.globalAlpha = 1;
		var val = parseFloat(weight) * 100;
		if (weight > 0.5) {
			start = white,
			end = red;
			val = val - 50;
		}
		var startColors = start.getColors(),
		endColors = end.getColors();
		var r = Interpolate(startColors.r, endColors.r, 50, val);
		var g = Interpolate(startColors.g, endColors.g, 50, val);
		var b = Interpolate(startColors.b, endColors.b, 50, val);

		colorBackground = "rgb(" + r + "," + g + "," + b + ")";

		colorBackground = colorBackground;
		ctx.fillStyle = colorBackground;
		ctx.fillRect(xPos, yPos, width, height);

		//Create Buttons up down

		ctx.strokeStyle = "white";
		//WHITE BACKGROUND
		if (type != 'result' && type != 'resultMoveable') {
			ctx.globalAlpha = 1;
			ctx.fillStyle = "white";
			ctx.fillRect(xPos, yPos + height - upDownButtonHeight, width, upDownButtonHeight);
			ctx.fillRect(xPos, yPos, width, upDownButtonHeight);
			//-------------------------------
			ctx.globalAlpha = 0.5;
			ctx.fillStyle = "blue";

			if (isOverUpButton) {
				ctx.globalAlpha = 0.1;
			}
			ctx.fillRect(xPos, yPos, width, upDownButtonHeight);
			ctx.globalAlpha = 0.5;
			if (isOverDownButton)
				ctx.globalAlpha = 0.1;
			ctx.fillRect(xPos, yPos + height - upDownButtonHeight, width, upDownButtonHeight);
			ctx.globalAlpha = 0.5;

			//Create arrows for buttons

			ctx.beginPath();
			drawUpArrow(xPos + width / 2, yPos + 6);
			drawDownArrow(xPos + width / 2, yPos +
				height - 5);
			ctx.stroke();
		}
		if (drawBoder) {
			ctx.globalAlpha = 0.8;
			ctx.strokeStyle = "white";
			ctx.lineWidth = 2;
			ctx.strokeRect(xPos, yPos, width - 2, height - 2);
		}

		ctx.font = "24px Times New Roman";
		ctx.fillStyle = colorFont;

		ctx.textAlign = "left";
		ctx.fillText(description, xPos, yPos + height - 30);
		if (type != 'resultMoveable')
			ctx.fillText(weight, xPos + 55, yPos + height - 60);
		else { //calculate score
			//controller.test();
			ctx.fillText(controller.calculateQMScore(qmBrick), xPos + 55, yPos + height - 60);
		}
		if (input != undefined) {
			input.render();
		}
	}

	var drawDownArrow = function (fromx, fromy) {

		ctx.moveTo(fromx, fromy);
		ctx.lineTo(fromx - 10, fromy - 10);

		ctx.moveTo(fromx, fromy);
		ctx.lineTo(fromx + 10, fromy - 10);
	}

	var drawUpArrow = function (fromx, fromy) {
		ctx.moveTo(fromx, fromy);
		ctx.lineTo(fromx - 10, fromy + 10);

		ctx.moveTo(fromx, fromy);
		ctx.lineTo(fromx + 10, fromy + 10);
	}

	var newResultName = function () {
		console.log("New result name " + input.value());
		description = input.value();
		//IT'S UGLY I KNOW
		input.x(-1000);
		input.y(-1000);
		input = null;
		console.log("here: " + controller);
		controller.draw();
	}

	//Public:
	qmBrick.hit = function (xHit, yHit) {
		if (xHit >= xPos && xHit <= xPos + width && yHit >= yPos && yHit <= yPos + height) {
			return (true);
		}
		return (false);
	}

	qmBrick.hitDownButton = function (xHit, yHit) {
		if (xHit >= xPos && xHit <= xPos + width && yHit >= yPos + height - upDownButtonHeight && yHit <= yPos + height) {
			return (true);
		}
		return (false);
	}

	qmBrick.hitUpButton = function (xHit, yHit) {
		if (xHit >= xPos && xHit <= xPos + width && yHit >= yPos && yHit <= yPos + upDownButtonHeight) {
			return (true);
		}
		return (false);
	}

	qmBrick.setOverUpButton = function (overUpButton) {
		isOverUpButton = overUpButton;
	}

	qmBrick.setOverDownButton = function (overDownButton) {
		isOverDownButton = overDownButton;
	}

	qmBrick.getOverUpButton = function () {
		return isOverUpButton;
	}

	qmBrick.getOverDownButton = function () {
		return isOverDownButton;
	}

	qmBrick.getHeight = function () {
		return height;
	}

	qmBrick.getWidth = function () {
		return width;
	}

	qmBrick.setWidth = function (w) {
		width = w;
	}

	qmBrick.setHeight = function (h) {
		height = h;
	}

	qmBrick.getX = function () {
		return xPos;
	}

	qmBrick.setX = function (x) {
		xPos = x;
	}

	qmBrick.getY = function () {
		return yPos;
	}

	qmBrick.setY = function (y) {
		yPos = y;
	}

	qmBrick.getBorder = function () {
		return drawBoder;
	}

	qmBrick.setBorder = function (border /*boolean*/
	) {
		drawBoder = border;
	}

	qmBrick.getType = function () {
		return type;
	}

	qmBrick.setPos = function (x, y) {
		if (type != 'menu') {
			xPos = x;
			yPos = y;
			if (input != undefined) {
				input.x(x);
				input.y(y + 40);
			}
		}
	}

	qmBrick.setSize = function (w, h) {
		width = w;
		height = h;
	}

	qmBrick.getDescription = function () {
		return description;
	}

	qmBrick.getWeight = function () {
		return weight;
	}

	qmBrick.setDescription = function (d) {
		description = d;
	}

	qmBrick.setWeight = function (w) {
		weight = w;
	}

	qmBrick.draw = function () {
		drawBrick();
	}

	qmBrick.compare = function (toCompare) {
		//TODO ADD AN ID
		//console.log("compare: " + xPos + " == " + toCompare.getX() + " && " + yPos + " == " + toCompare.getY() + " && " + type + " == " + toCompare.getType() + " && " + description + " == " + toCompare.getDescription());
		if (xPos == toCompare.getX() && yPos == toCompare.getY() && type == toCompare.getType() && description == toCompare.getDescription())
			return true;
		return false;
	}

	qmBrick.getValue = function () {
		return value;
	}

	qmBrick.setValue = function (v) {
		value = v;
	}

	qmBrick.getTotalScore = function () {
		//console.log("DESCRIPSTION: " + description + " weight : "+weight + " value: " + value + " total socre: " + parseFloat(weight * value));
		return parseFloat(weight * value);
	}

	return qmBrick;
}

module.exports = {
	"env": {
		"browser": true,
		"es6": true
	},
	"globals": {
		"$": false,
		"jQuery": false
	},
	"extends": "eslint:recommended",
	"rules": {
		"indent": [
			"error",
			"tab"
		],
		"linebreak-style": [
			"error",
			"unix"
		],
		"quotes": [
			"error",
			"single"
		],
		"semi": [
			"error",
			"always"
		],
		"eqeqeq": [
			"error"
		],
		"curly": [
			"error"
		],
		"camelcase": [
			"error"
		],
		"brace-style": [
			"error",
			"1tbs"
		],
		"object-curly-spacing": [
			"error",
			"never"
		],
		"yoda": [
			"error",
			"never"
		]
	}
};

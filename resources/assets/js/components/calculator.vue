<!-- Another good component from ahimbisibwe roland -->
<template>
	<div>
	<a href="#" class="text-secondary" @click="show=!show">	
		<i class="fa fa-calculator fa-lg text-white" ></i>
		Calculator
	</a>
		<zoom>
			<form class="calc"  v-if="show">
			  <p class="calc-display">
			    <input type="text"  :value="calculatedValue" class="calc-display-input" onfocus="this.blur()">
			  </p>
			  <p class="calc-row">
			    <button type="button" class="calc-button calc-button-gray" @click="value='....do..'">
			    	mrc
			    </button>
			    <button type="button" class="calc-button calc-button-gray" onclick="s('....do..')">m-</button>
			    <button type="button" class="calc-button calc-button-gray" onclick="s('......it')">m+</button>
			    <button type="button" class="calc-button calc-button-red calc-button-big" 
			    		@click="addToScreen('/')">
			    		÷
			    </button>
			  </p>
			  <p class="calc-row">
			    <button type="button" class="calc-button" @click="addToScreen('7')">7</button>
			    <button type="button" class="calc-button" @click="addToScreen('8')">8</button>
			    <button type="button" class="calc-button" @click="addToScreen('9')">9</button>
			    <button type="button" class="calc-button calc-button-red calc-button-big" @click="addToScreen('*')">x</button>
			  </p>
			  <p class="calc-row">
			    <button type="button" class="calc-button" @click="addToScreen('4')">4</button>
			    <button type="button" class="calc-button" @click="addToScreen('5')">5</button>
			    <button type="button" class="calc-button" @click="addToScreen('6')">6</button>
			    <button type="button" class="calc-button calc-button-red calc-button-big" @click="addToScreen('-')">-</button>
			  </p>
			  <p class="calc-row">
			    <button type="button" class="calc-button" @click="addToScreen('1')">1</button>
			    <button type="button" class="calc-button" @click="addToScreen('2')">2</button>
			    <button type="button" class="calc-button" @click="addToScreen('3')">3</button>
			    <button type="button" class="calc-button calc-button-red calc-button-big" @click="addToScreen('+')">+</button>
			  </p>
			  <p class="calc-row">
			    <button type="button" class="calc-button" @click="addToScreen('0')">0</button>
			    <button type="button" class="calc-button" @click="addToScreen('.')">.</button>
			    <button type="button" class="calc-button" @click="value=''">C</button>
			    <button type="button" class="calc-button calc-button-yellow calc-button-big" 
			    	@click="evaluate()">
			    	=
			    </button>
			  </p>
			</form>
		</zoom>
	</div>
</template>

<script>

	export default
	{

		props:[],

		data(){
			return {
				value:'',
				show:false,
			}
		},
		methods:{

			addToScreen(char)
			{
				this.value+= char;
			},
			evaluate()
			{
				try {
					this.value=eval(this.value)
				} catch(e) {
					this.value="Error"
				}
				
			},
			
		},
		computed:{
			calculatedValue()
			{
				if (this.value) {
					return this.value;
				}
				return "On";
			}
		}
	}
</script>

<style>


	/*
	 * Copyright (c) 2012-2013 Thibaut Courouble
	 * http://www.cssflow.com
	 *
	 * Licensed under the MIT License:
	 * http://www.opensource.org/licenses/mit-license.php
	 */
	input, button {
	  -webkit-box-sizing: border-box;
	  -moz-box-sizing: border-box;
	  box-sizing: border-box;
	}

	::-moz-focus-inner {
	  padding: 0;
	  border: 0;
	}

	@font-face {
	  font-family: 'UbuntuMono';
	  font-style: normal;
	  font-weight: normal;
	  src: url(../../fonts/UbuntuMono.woff) format("woff");
	}

	.calc {
	  position: fixed;
	  top: 80px;
	  /* margin: 50px auto; */
	  padding: 15px;
	  right: 10px;
	  width: 210px;
	  background: #3d4543;
	  border: 1px solid #222;
	  border-radius: 4px;
	  background-image: -webkit-linear-gradient(top, #3d4543, #2f2a2f);
	  background-image: -moz-linear-gradient(top, #3d4543, #2f2a2f);
	  background-image: -o-linear-gradient(top, #3d4543, #2f2a2f);
	  background-image: linear-gradient(to bottom, #3d4543, #2f2a2f);
	  -webkit-box-shadow: inset 0 0 0 1px rgba(255, 255, 255, 0.1), 0 0 4px rgba(0, 0, 0, 0.5);
	  box-shadow: inset 0 0 0 1px rgba(255, 255, 255, 0.1), 0 0 4px rgba(0, 0, 0, 0.5);
	}

	.calc-display {
	  margin: 0 0 20px;
	  padding: 3px;
	  background: #222;
	  border-radius: 3px;
	  -webkit-box-shadow: inset 0 0 0 1px rgba(0, 0, 0, 0.1), 0 0 0 1px rgba(255, 255, 255, 0.08);
	  box-shadow: inset 0 0 0 1px rgba(0, 0, 0, 0.1), 0 0 0 1px rgba(255, 255, 255, 0.08);
	}

	.calc-display-input {
	  display: block;
	  width: 100%;
	  height: 35px;
	  padding: 0 8px;
	  font: 26px/35px UbuntuMono, monospace;
	  color: #444;
	  text-align: right;
	  background: #bccd95;
	  background-clip: padding-box;
	  /* Don't let the background bleed outside the border */
	  border: 1px solid #222;
	  border-radius: 2px;
	  background-image: -webkit-linear-gradient(top, #bccd95, #e0f5b1);
	  background-image: -moz-linear-gradient(top, #bccd95, #e0f5b1);
	  background-image: -o-linear-gradient(top, #bccd95, #e0f5b1);
	  background-image: linear-gradient(to bottom, #bccd95, #e0f5b1);
	  -webkit-box-shadow: inset 0 2px 3px rgba(0, 0, 0, 0.5), 0 0 0 1px rgba(255, 255, 255, 0.12);
	  box-shadow: inset 0 2px 3px rgba(0, 0, 0, 0.5), 0 0 0 1px rgba(255, 255, 255, 0.12);
	}

	.calc-row {
	  margin-top: 7px;
	  zoom: 1;
	}
	.calc-row:before, .calc-row:after {
	  content: '';
	  display: table;
	}
	.calc-row:after {
	  clear: both;
	}

	.calc-button {
	  float: left;
	  padding: 0;
	  margin: 0 0 0 7px;
	  width: 39px;
	  font: 14px/23px UbuntuMono, monospace;
	  color: white;
	  text-align: center;
	  text-decoration: none;
	  text-shadow: 0 1px rgba(0, 0, 0, 0.4);
	  background: #313131;
	  background-clip: padding-box !important;
	  /* !important because FF overrides the value on :active */
	  border: 0;
	  /* IE 8 fix */
	  border: 1px solid rgba(0, 0, 0, 0.8);
	  border-radius: 3px;
	  cursor: pointer;
	  background-image: -webkit-linear-gradient(top, #313131, #1c1c1c);
	  background-image: -moz-linear-gradient(top, #313131, #1c1c1c);
	  background-image: -o-linear-gradient(top, #313131, #1c1c1c);
	  background-image: linear-gradient(to bottom, #313131, #1c1c1c);
	  -webkit-box-shadow: inset 0 0 0 1px rgba(255, 255, 255, 0.08), 0 1px rgba(0, 0, 0, 0.3), 0 0 0 1px rgba(255, 255, 255, 0.08);
	  box-shadow: inset 0 0 0 1px rgba(255, 255, 255, 0.08), 0 1px rgba(0, 0, 0, 0.3), 0 0 0 1px rgba(255, 255, 255, 0.08);
	}
	.calc-button:first-child {
	  margin-left: 0;
	}
	.calc-button:active {
	  background: #282828;
	  -webkit-box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.6), 0 1px rgba(0, 0, 0, 0.1), 0 0 0 1px rgba(255, 255, 255, 0.05);
	  box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.6), 0 1px rgba(0, 0, 0, 0.1), 0 0 0 1px rgba(255, 255, 255, 0.05);
	}

	.calc-button-gray {
	  background: #6f6f6f;
	  background-image: -webkit-linear-gradient(top, #6f6f6f, #515151);
	  background-image: -moz-linear-gradient(top, #6f6f6f, #515151);
	  background-image: -o-linear-gradient(top, #6f6f6f, #515151);
	  background-image: linear-gradient(to bottom, #6f6f6f, #515151);
	}
	.calc-button-gray:active {
	  background: #555;
	}

	.calc-button-red {
	  background: #ff4561;
	  background-image: -webkit-linear-gradient(top, #ff7286, #ff4561);
	  background-image: -moz-linear-gradient(top, #ff7286, #ff4561);
	  background-image: -o-linear-gradient(top, #ff7286, #ff4561);
	  background-image: linear-gradient(to bottom, #ff7286, #ff4561);
	}
	.calc-button-red:active {
	  background: #ff4561;
	}

	.calc-button-yellow {
	  background: #ffa70c;
	  background-image: -webkit-linear-gradient(top, #ffb935, #ffa70c);
	  background-image: -moz-linear-gradient(top, #ffb935, #ffa70c);
	  background-image: -o-linear-gradient(top, #ffb935, #ffa70c);
	  background-image: linear-gradient(to bottom, #ffb935, #ffa70c);
	}
	.calc-button-yellow:active {
	  background: #ffa70c;
	}

	.calc-button-big {
	  font-size: 16px;
	}

	.lt-ie8 .calc-display-input {
	  width: 152px;
	}

	/* border-box fix */
	.lt-ie7 .calc-row {
	  margin-left: -7px;
	}

	/* first-child fix */

</style>
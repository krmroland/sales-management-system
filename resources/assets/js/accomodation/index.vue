<template>
	<div>
		<card>
			 <h4 class="text-info" slot="title">Acommodation Section</h4>
			<div class="box text-center d-flex justify-content-between align-items-center">
				<i class="fa fa-university text-primary fa-4x"></i>
				<switchery :buttons="buttons" @switched="swapPage"></switchery>
				<i class="fa fa-bed text-primary fa-4x"></i>
			</div>
		</card>
		<zoom>
			<components :is="page"></components>
		</zoom>
	</div>
</template>

<script>

	import rooms from "../rooms/index";
	import switchery from "../switch/switchery";
	import payment from "./payment.vue";
	import history from "./history";
	export default
	{
		components:{rooms,switchery,payment,history},

		/**
		 * The data object
		 *
		 * @return     {Object}
		 */
		 data()
		 {
		 	return {
		 		page:"history",
		 		/*the buttons we will toggle*/
		 		buttons:[
		 		{
		 			icon:"fa fa-shopping-cart",
		 			text:"Make A new Room Payment",
		 			key:"payment",


		 		},
		 		{
		 			icon:"fa fa-history",
		 			text:"Recently made Payments ",
		 			key:"history",
		 			isActive:true
		 		},
		 		{
		 			icon:"fa fa-home",
		 			text:"Available Rooms",
		 			key:"rooms",
		 		}
		 		]
		 	}
		 },

		 methods:{
			/**
			 * swap the pahe being shown when the buttond are switched
			 */
			 swapPage(page)
			 {
			 	this.page=page;
			 }
			}

		}
	</script>

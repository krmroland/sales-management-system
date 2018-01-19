<template>
	<div>
		<card>

			<h4 slot="title" class="text-info">The Parking</h4>


			<div class="d-flex justify-content-between align-items-center box">
				<i class="fa fa-motorcycle fa-5x text-primary"></i>
				<switchery :buttons="buttons" @switched="page=$event"></switchery>
				<button class="btn btn-primary" @click="shouldCreateVehicle=true">
					<i class="fa fa-plus"></i>
					Register A new Vehicle
				</button>	
				<i class="fa fa-bus fa-5x text-primary"></i>
			</div>
			
		</card>	
		<zoom>
			<component :is="page"></component>	
		</zoom>

		<modal :show="shouldCreateVehicle" @closed="shouldCreateVehicle=false">
			<h3 slot="header">Register A New Vehicle</h3>
			<create-vehicle @submitted="shouldCreateVehicle=false">
				
			</create-vehicle>
		</modal>
	</div>
</template>

<script>
	import switchery from "../switch/switchery";
	import payments from "./payments";
	import CreateVehicle from "../vehicles/create";
	import Vehicles from "../vehicles/index";
	import History from "./history";

	export default
	{	
		components:{switchery,payments,CreateVehicle,Vehicles,History},

		props:[],

		data(){
			return {
				shouldCreateVehicle:false,
				page:"history",

				buttons:[
				// {
				// 	icon:"fa fa-bar-chart-o",
				// 	text:"Parking Summary",
				// 	key:"summary",
					

				// },
				{
					icon:"fa fa-shopping-cart",
					text:"Capture A New Receipt",
					key:"payments",

				},
				{
					icon:"fa fa-history",
					text:"Recently Captured Receipt ",
					key:"history",
					isActive:true,


				}
				,
				{
					icon:"fa fa-car",
					text:"Registered Vehicles",
					key:"vehicles",


				}
				]
			}
		},
		methods:{
			
		}
	}
</script>

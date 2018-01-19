<template>
	<div>
		<card>
			
			<h5 slot="title" class="text-info">{{title|title}}</h5>
			<div class="box d-flex justify-content-between align-items-center">
				<i class="fa fa-handshake-o fa-5x text-primary"></i>
				<div>
					<switchery :buttons="buttons" @switched="swapPage"></switchery>
				</div>
				<i class="fa fa-shopping-basket text-primary fa-5x"></i>
			</div>
		</card>	
		<zoom>
			<component :is="page" :type="type"></component>
		</zoom>
		
	</div>
</template>

<script>
	import switchery from "../switch/switchery";

	import create from "./create";
	
	import history from "./history";



	export default{
		props:["type"],

		components:{switchery,create,history},
		
		data()
		{
			return {
				page:"create",

				buttons:[
				{
					icon:"fa fa-shopping-cart",
					text:"Make A new"+this.type,
					key:"create",
					confirmation:false,
					isActive:true

				},
				{
					icon:"fa fa-history",
					text:"Recent "+this.type+"s",
					key:"history",

					confirmation:false


				}
				]
			}
		},
		methods:{
			swapPage(page)
			{
				this.page=page
			}
		},
		computed:{
			title()
			{
				return this.type=="purchase"?
				"Purchases Platiform":
				"Sales Platiform";
			}
		}
	}
</script>
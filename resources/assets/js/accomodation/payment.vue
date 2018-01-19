<template>
	<div>
		<div>
			<card>
				<div class="row no-gutters History">
					
					<div class="col-md-9">
						<card>
							
							<h4 slot="title">Please Make A Room PaymentPayment</h4>
							<search-selector endPoint="/rooms"@selected="foundRoom"
							@unSelected="room=null"
							label="Please search for a room">
							<search-attribute dataName="name"   css="text-info" filter="title">
								
							</search-attribute>
							<search-attribute dataName="number" css="px-2" 
							filter="title" 
							prepends="(" appends=" )"
							@selected="room=$event"
							>
						</search-attribute>
					</search-selector>
				</card>
			</div>
			<!-- the car history -->
			<div class="col-md-3 History-right p-0 m-0">
				<div class="History-heading sticky-top">
					<h2 class="text-center">History</h2>
				</div>
				<div class="History-contents">

					<ul class="list-group" v-for="(entry,index) in history">

						<li class="list-group-item justify-content-between" :key="index">
							<span>{{++index}}.</span>
							{{entry.name}} ({{entry.number}})
							<span class="badge badge-default badge-pill p-1">
								{{entry.ammount|currency}}
							</span>
						</li>

					</ul>

				</div>
			</div>

		</div>
	</card>
	<zoom>
		<card v-if="room">
			<room :room="room"></room>
		</card>
	</zoom>
</div>
<zoom>
	<card v-if="room">
		<p class="form-text h4 text-center text-muted">Please Make A Payment</p>
		<VueForm :action="'rooms/'+room.id+'/payments'" 
		:fields="fields" :fieldsPerRow="3" fieldsClass="box mb-2"
		@submitted="refreshPage"
		>

	</VueForm>

</card>
</zoom>	

</div>
</template>

<script>
	let 
	rates={

		name:"rate",
		label:"Please select  the charge rate",
		hasKeys:true,
		options:[],
		setRate(options){
			this.options=options;

		}
	}

	import VueForm from "../forms/VueForm";
	import Confirmation from "../Confirmation";
	import room from "../rooms/room";
	export default
	{
		components:{VueForm,room},
		created()
		{	
			this.fetchHistory();

			events.$on("room:created",room=>{
				events.$emit("selector:update",room);
			})

		},

		data(){
			return {
				room:null,
				history:[],
				fields:[
				
				{
					name:"date",
					type:"date",
					label:"Please select A date",


				},
				rates,
				{
					name:"units",
					options:[1,2,3,4,5,6],
					label:"Select the number of units,eg 2 for two months"
				}
				],


			}
		},
		methods:{

			foundRoom(room)
			{
				this.room=room;

				let formatedRates={};

				for(let name in  room.rates){
					formatedRates[name]=this.numberFormat(room.rates[name])+'(@'+ name +')';
				}
				rates.setRate(formatedRates);

			},
			setUnits()
			{
				

			},

			refreshPage($payment)
			{
				this.room=null;
				
				flash("Payment was captured Successfully");

				this.fetchHistory();

				events.$emit("selector:update",null);

			},

			fetchHistory()
			{
				axios.get("/accomodation?miniHistory=true").then(({data})=>{
					this.history=data;
				});
			}

			

		},
	}
</script>

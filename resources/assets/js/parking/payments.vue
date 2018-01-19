<template>
	<div>
		<div>
			<card>
				<div class="row no-gutters History">
					
					<div class="col-md-9">
						<card>
							
							<h4 slot="title">Please Make A new Car Payment</h4>
							<search-selector endPoint="/vehicles"@selected="foundVehicle"
							@unSelected="vehicle=null"
							label="Please search for a vehicle number plate">
							<search-attribute dataName="numberPlate"   css="text-info"></search-attribute>
							<search-attribute dataName="owner"  prepends=" (" appends=" )" css="px-1"></search-attribute>
							<search-attribute dataName="phoneNumber"  prepends=" [" appends="]" css="px-1"></search-attribute>
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
								<i class="fa fa-lg" :class="'fa-'+entry.icon"></i>
								{{entry.numberPlate}}
								<span class="badge badge-default badge-pill p-1">
									{{entry.paid|currency}}
								</span>
							</li>
							
						</ul>
						
					</div>
				</div>
				
			</div>
		</card>
		<zoom>
			<vehicle :vehicle="vehicle"  v-if="vehicle"></vehicle>
		</zoom>
	</div>
	<zoom>
		<card v-if="vehicle">
			<p class="form-text h4 text-center text-muted">Please Make A Payment</p>
			<VueForm :action="endPoint" 
			:fields="fields" :fieldsPerRow="2" fieldsClass="box mb-2"
			:beforeSubmitCallBack="verifyDoubleEntry" 
			@submitted="refreshPage"
			>

		</VueForm>

	</card>
</zoom>	

</div>
</template>

<script>
	let paid={
		name:"paid",
		label:"The ammount Paid by the user",
		min:0,

		setValue(value){
			if(!value){
				this.value=0;
			}else{
				this.value=value<0?0:value;
			}
			
		}
	};
	import VueForm from "../forms/VueForm";
	import Confirmation from "../Confirmation";
	import vehicle from "../vehicles/vehicle";
	export default
	{
		components:{VueForm,vehicle},
		created()
		{	
			this.fetchHistory();

			events.$on("vehicle:created",vehicle=>{
				events.$emit("selector:update",vehicle);
			})

		},

		data(){
			return {
				vehicle:null,
				history:[],
				searchValue:null,
				fields:[
				

				{
					name:"date",
					type:"date",
					label:"Please select A date",


				},
				paid,
				],


			}
		},
		methods:{

			foundVehicle(vehicle){
				this.vehicle=vehicle;
				paid.setValue(Number(vehicle.fee)-Number(vehicle.accountBalance));
			},
			verifyDoubleEntry(form)
			{
				return new Promise((resolve,reject)=>{
					axios.get("/vehicle/"+this.vehicle.vehicle_id+"/payments/verify?date="+form.date).
					then(({data})=>{
						if (data) {
							return this.confirmDoubleEntry(resolve,reject);
						}else{
							return resolve();
						}
					});
				});
			},
			confirmDoubleEntry(resolve,reject)
			{
				Confirmation.confirm("Double Entry?","The record is already captured").
				then(()=>{
					return resolve();
				}).catch(()=>{
					return reject();
				});
			},

			refreshPage($payment)
			{
				this.vehicle=null;
				
				flash("Payment was captured Successfully");

				this.history.unshift($payment);

				events.$emit("selector:update",null);

			},
			fetchHistory()
			{
				axios.get("/parking?miniHistory=true").then(({data})=>{
					this.history=data;
				});
			}

			

		},
		/**
		 * The computed properties
		 */
		 computed:{

		 	endPoint()
		 	{
		 		if (this.vehicle) {
		 			return "/vehicle/"+this.vehicle.vehicle_id+"/payments";
		 		}
		 	}
		 	
		 }
		}
	</script>

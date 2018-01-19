<template>
	<div>
		<card>
			<h4 slot="title" class="text-primary">Reports Generator</h4>
			<div class="d-flex justify-content-between align-items-center box text-center">
				<i class="fa fa-pie-chart fa-5x text-primary"></i>

				<!-- the report items -->
				<div class="custom-controls-stacked">
					<h5>Report Details</h5>
					<!-- detaisl -->
					<template v-for="item in allItems">
						<label class="custom-control custom-checkbox">
							<input type="checkbox" class="custom-control-input" :value="item"
							v-model="items">
							<span class="custom-control-indicator"></span>
							<span class="custom-control-description">{{item|title}}</span>
						</label>
					</template>
				</div>

				<!-- the report type -->
				<div class="custom-controls-stacked">
					<h5>Report Type</h5>
					
					<template v-for="option in types">
						<label class="custom-control custom-radio">
							<input type="radio" class="custom-control-input" :value="option" v-model="type">
							<span class="custom-control-indicator"></span>
							<span class="custom-control-description">{{option|title}}</span>
						</label>
					</template>
				</div>

				<!-- the report dates -->
				<div class="col-md-3">
					<date :label="dateLabel" :mode="dateMode" @dateChanged="date=$event">
						
					</date>
				</div>
				<i class="fa fa-bar-chart fa-5x text-primary"></i>
			</div>
		</card>
		<general-summary :reports="reports" :date="date"></general-summary>
		<animation-list>
			<div v-for="(data,name) in reports" :key="name" >
				<component :is="name" :data="data" :date="date"></component>
			</div>
		</animation-list>


		<processor message="Compliling Reports" :shouldProcess="isCompiling">

		</processor>
	</div>
</template>

<script>

	import date from "../components/date";
	import processor from "../components/processor";
	//reports
	import sales from "./SalesReport";
	import purchases from "./PurchasesReport";
	import parking from "./ParkingReport";
	import accomodation from "./AccomodationReport";
	import expenditure from "./ExpenditureReport";
	import salaries from "./SalariesReport";
	import GeneralSummary from "./GeneralSummary";
	import OtherIncomes from "./OtherIncomesReport";

	//let items=["sales","purchases","accomodation","parking","expenditure"];
	let items=["sales","purchases","parking","accomodation","expenditure","salaries","otherIncomes"];

	export default
	{
		components:{
			date,sales,purchases,processor,parking,accomodation,expenditure,salaries,GeneralSummary,OtherIncomes
		},

		created()
		{
			this.fetchReports();
		},
		data(){
			return {
				type:"daily",
				allItems:items,
				items:items,
				types:["daily","weekly","range"],
				fetchedReports:{},
				date:'',
				isCompiling:false,

				buttons:[
				
				{
					icon:"fa fa-shopping-cart",
					text:"Range Reports",
					key:"daily",
					isActive:true,

				},
				{
					icon:"fa fa-history",
					text:"Daily Reports",
					key:"range",
					


				}],

			}
		},
		computed:{
			dateLabel()
			{
				return this.type=="daily"?"Select A Single date":"Select A Range of Dates"
			},
			dateMode()
			{
				switch (this.type) {
					case "daily":
					return "single";
					case "range":
					return "range";
					case "weekly":
					return "weeks";


				}
			},
			reportData()
			{
				return {
					date:this.date,
					items:this.items,
					
				};
			},
			reports()
			{

				let reports={};

				this.items.map((item)=>{
					let report=this.fetchedReports[item];
					if (report) {
						reports[item]=this.fetchedReports[item];	
					}
				})
				return reports;
			}
		},
		methods:{
			fetchReports()
			{
				this.isCompiling=true;
				axios.post("reports",this.reportData).then(({data})=>{
						this.fetchedReports=data;
						this.isCompiling=false;
					}).catch(error=>this.isCompiling=false);
			}
		},
		watch:{
			date(){
				this.fetchReports();
			}
		}
	}
</script>

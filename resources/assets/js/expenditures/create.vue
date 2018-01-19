<template>
	<div>
		<card>
			<h4 class="text-info" slot="title">Expenditures Platiform</h4>
			<div class="d-flex align-items-center justify-content-between mb-1 box">
				<div>
					<i class="fa fa-handshake-o fa-5x text-primary"></i>
				</div>
				
				<div class="button-group">
					<button type="button" class="btn btn-outline-primary" @click="createExpenditure('general')">
						<i class="fa fa-money"></i>
						New General Expenditure
					</button>
					<button type="button" class="btn btn-outline-primary" @click="createExpenditure('bills')">
						<i class="fa fa-credit-card-alt"></i>
						Pay A New Bill
					</button>
				</div>
				<i class="fa fa-th-large fa-5x text-primary"></i>
			</div>
		</card>

		<modal :show="isAdding" @closed="isAdding=false">
			<h3 slot="header">{{(type && type=="general")?'Record A general Expenditure':'Pay A bill'}}</h3>
			<VueForm action="/expenditures" :fields="fields" @submitted="expenditureCreated">
				
			</VueForm>
		</modal>	
	</div>
</template>

<script>
	import VueForm from "../forms/VueForm";


	export default
	{

		components:{VueForm},



		props:[],

		data(){
			return {

				type:"general",

				isAdding:false,

				fields:[
				{
					name:"date",
					label:"Please select a date when the transaction was made",
					type:"date"
				},
				
				{
					name:"category",
					label:"Please select a type",
					options:[]

				},
				{
					name:"type",
					type:"text",
					value:null,
					type:"hidden"
				},

				{
					name:"ammount",
					label:"The ammount Spent",
					min:0
				},

				{
					name:"description",
					label:"Give a brief description about the expenditure",
				},

				


				]
			}
		},
		methods:{
			createExpenditure(type)
			{
				this.type=type;
				this.$set(this.fields[1],'options',window.company.expenditure[type]);
				this.$set(this.fields[2],'value',type);
				this.isAdding=true;
			},
			expenditureCreated($expenditure)
			{
				this.isAdding=false;

				events.$emit("table:refresh",$expenditure);

			}
		}
	}
</script>

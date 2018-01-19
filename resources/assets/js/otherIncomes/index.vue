<template>
	<div>
		<card>
			<h2 slot="title" class="text-info">Other Generated Income</h2>
			<div class="d-flex justify-content-between align-items-center box">
				<i class="fa fa-money fa-4x text-primary"></i>
				<button class="btn btn-outline-primary" @click="addingIncome=true">
					<i class="fa fa-plus"></i>
					Record A new Income

				</button>
				<i class="fa fa-credit-card fa-4x text-primary"></i>
			</div>
			
			<p class="text-primary font-italic text-center text-primary mb-0">
				The one time collected incomes examples inclued <strong class="text-center text-info">dstv, gardens</strong> and others taht may be defined
			</p>

		</card>
		<modal :show="addingIncome" @closed="addingIncome=false">
			<h2 slot="header">Record A new Income</h2>
			<VueForm action="/otherIncomes" :fields="fields" @submitted="incomeAdded" >
			</VueForm>
		</modal>
		<card>
			<h4 slot="title" class="text-info">The Recently Recorded Incomes</h4>
			<table class="table table-bordered table-hover table-sm table-striped">
				<thead>
					<tr>
						<th>Date</th>
						<th>Category</th>
						<th>Cash Collected</th>
						<th>Profit Gained</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="income in incomes">
						<td>{{income.date}}</td>
						<td>{{income.category|title}}</td>
						<td>{{income.cashCollected|currency}} /=</td>
						<td>{{income.profit|currency}} /=</td>
						<td class="p-0 m-0 text-center">
							<button class="btn btn-outline-danger btn-sm" @click="destroy(income)">
								<i class="fa fa-trash "></i>
								Remove
							</button>
						</td>

					</tr>
				</tbody>
			</table>

		</card>
	</div>
</template>

<script>

	import VueForm from "../forms/VueForm";
	import Confirmation from "../Confirmation";

	export default
	{
		components:{VueForm},

		props:[],

		created()
		{
			this.fetchHistory();
		},
		methods:{
			fetchHistory()
			{
				axios.get("/otherIncomes").then(({data})=>this.incomes=data);
			},
			incomeAdded(income)
			{
				
				this.incomes.unshift(income); 
				this.addingIncome=false;
				flash("Income was added successfully");
			},
			destroy(record)
			{
				Confirmation.confirm("Stop!","The record will be deleted permanetly").then(confirmed=>{
					axios.delete("/otherIncomes/"+record.id).then(response=>{
						this.fetchHistory();
						flash("Record was removed successfully");
					})
				});

			
			},

		},

		data(){
			return {
				incomes:[],

				addingIncome:false,
				fields:[
				{
					name:"date",
					type:"date",
				},
				{
					name:"category",
					options:window.company.categories.otherIncomes,
					label:"Choose icome type eg dstv . You can go to configurations and register it if it doesnot exist"

				},
				{
					name:"cashCollected",
					label:"The Cash Collected eg 20000 for dstv",
					min:0
				}
				,
				{
					name:"profit",
					label:"The profit earned on this transaction",
					min:0,
				}
				// ,
				// {
				// 	name:"expenditure",
				// 	label:"The expenditure incured (optional)",
				// 	min:0
				// }
				]

			}
		}
	}
</script>

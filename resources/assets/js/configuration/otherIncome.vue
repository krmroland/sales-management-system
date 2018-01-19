<template>
	<card>

		<h4  class="text-info text-center">Configure Your other Incomes </h4>
		<card>
			<div class="box row  d-flex align-items-center ">
				

				<div class="col-md-6">
					<ul class="list-group text-center">
						<li class="list-group-item active justify-content-center h5 text-secondary">
							Registered Incomes
						</li>
						<li class="list-group-item justify-content-center text-primary text-center p-0 m-0" 
						v-for="(income,index) in incomes">
							<span class="">{{++index}}.</span>
							<i class="fa fa-globe text-center mr-auto"></i>
							<span class="strong mr-auto">{{income.name|title}}</span>
							<div class="p-1">
								<button class="btn  btn-outline-danger" @click="destroy(income)">
									<i class="fa fa-trash-o"></i>
									Remove
								</button>
							</div>
						</li>
						
					</ul>
				</div>

				<div class="col-md-6 box">
					<div class="mb-2">
						<button class="btn btn-outline-info btn-block" @click="addingIncome=true">
							<i class="fa fa-plus"></i>
							New Income Type Name
						</button>
					</div>
					<p class="text-primary text-center font-italic box-1">
						This section is meant for configuring the other incomes eg dstv and gardens . Its only purpose is to achieve consistency in naming that would give us problems in report generation!
					</p>
					
				</div>
			</div>
		</card>

		<modal :show="addingIncome" @closed="addingIncome=false">
			<h4 slot="header">Add A new Income Type eg dstv</h4>
			<VueForm action="/categories/otherIncomes" :fields="fields"
			@submitted="addedIncome">

		</VueForm>
	</modal>
</card>
</template>

<script>
	import VueForm from "../forms/VueForm";
	import Confirmation from "../Confirmation";

	export default
	{
		components:{VueForm},
		props:[],

		data(){
			return {
				addingIncome:false,

				incomes:window.company.otherIncomes,
				fields:[{
					name:"name",
					label:"The name of the other icome eg dstv"
				}]
			}
		},
		methods:{
			addedIncome(income)
			{
				this.incomes.unshift(income);
				this.addingIncome=false;
			},
			destroy(income)
			{
				Confirmation.confirm("Stop!","The income will be removed permanently").
				then(response=>axios.delete("/categories/"+income.id).then(({data})=>{
					location.reload();
					
					flash("Income  was removed successfully");
				}));
			},

		}
	}
</script>

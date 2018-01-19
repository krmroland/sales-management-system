<template>
	<div>
		<card>
			<h4  class="text-info" slot="title">The Available Employees</h4>
			<div class=" row d-flex align-items-center  justify-content-between text-center mx-2 box">
				<div>
					<i class="fa fa-users fa-4x text-primary"></i>
				</div>
				<div>
					
					<p class="h5">Total Employees</p>
					<p class="h4">
						<counter :value="employees.length"></counter>
					</p>
				</div>
				<div class="">
					<button class="btn btn-outline-primary mb-2" @click="addingEmployee=true">
						<i class="fa fa-plus"></i>
						Register A New Employee
					</button>
				</div>
				<i class="fa fa-star-o fa-5x text-primary"></i>
			</div>

		</card>

		<card>
			<search-selector label="Filter An Employee" endPoint="/employees" :hasDropDown="false" 
				@results="employees=$event">
				
			</search-selector>
		</card>	

        <animation-list>
        	<template  v-for="employee in employees">
        		<employee :employee="employee" :readonly="false" :key="employee.id"></employee>
        	</template>
        </animation-list>
		<modal :show="addingEmployee" @closed="addingEmployee=false">
			<h4 slot="header">Register A New Employee</h4>
			<create @employee:created="registeredEmployee"></create>
		</modal>
</div>
</template>

<script>

	import create from "./create";
	import employee from "./employee";
	export default
	{
		components:{create,employee},

		created()
		{
			this.fetchEmployees();
		},


		data(){
			return {
				addingEmployee:false,
				employees:[],

			}
		},
		methods:{
			registeredEmployee(employee)
			{
				this.addingEmployee=false;

				this.employees.unshift(employee);
			},
			fetchEmployees()
			{
				axios.get("/employees").then(({data})=>this.employees=data);
			}
		}
	}
</script>

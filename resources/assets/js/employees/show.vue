<template>
	<div>
		<employee :employee="employeeCopy"></employee>
		<card>
			<div class="d-flex  row justify-content-between align-items-center mx-3 text-center box">
				<div class="">
					<h3 class="text-info">
						{{employeeCopy.name}}`s 
						<span class="fon-italic small text-muted">Profile</span>
					</h3>
				</div>
				<div class="btn-group">
					<button type="button" class="btn btn-outline-primary" @click="isBeingPaid=true">
						<i class="fa fa-handshake-o"></i>
						Make A Payment
					</button>
					<button type="button" class="btn btn-outline-primary" @click="isEditing=true">
						<i class="fa fa-edit"></i>
						Edit Profile
					</button>
					<button type="button" class="btn btn-outline-primary" @click="isAddingAvatar=true">
						<i class="fa fa-camera"></i>
						Uploade Image
					</button>

					<button type="button" class="btn btn-outline-danger" @click="destroy">
						<i class="fa fa-trash"></i>
						Delete Account
					</button>

				</div>
			</div>
		</card>
		<!-- the modal fro editing an employee -->
		<modal :show="isEditing" @closed="isEditing=false">
			<h4 slot="header">Update <strong>{{employeeCopy.name}}</strong>` Profile</h4>
			<VueForm :action="'/employees/'+employeeCopy.id" :fields="fields" method="put" @submitted="edited">
			</VueForm>
		</modal>
		<!-- handle employee payments -->
		<modal :show="isBeingPaid" @closed="isBeingPaid=false">
			<h4 slot="header">Pay<strong>{{employeeCopy.name}}</strong></h4>
			<pay-employee :employee="employeeCopy" @employee:paid="employeePaid"></pay-employee>
		</modal>
		<salaries :employee="employeeCopy"></salaries>
		
		<avatar-adder :id="employeeCopy.id" model="employee" :isAddingAvatar.sync="isAddingAvatar" 
						@avatarUpdated="employeeCopy=$event">
			
		</avatar-adder>
	</div>
</template>

<script>
	import employee from "./employee";

	import Confirmation from "../Confirmation";

	import VueForm from "../forms/VueForm";

	import structure from "./structure";

	import PayEmployee from "./payments/create";

	import salaries from "./payments/index";

	import AvatarAdder from "../components/avatarAdder";

	export default 
	{
		components:{employee,VueForm,PayEmployee,salaries,AvatarAdder},

		props:["employee"],

		data(){
			return {

				isEditing:false,
				fields: (new structure()).binded(this.employee),
				employeeCopy:this.employee,
				isBeingPaid:false,
				isAddingAvatar:false,
			}
		},
		methods:{
			/**
			 * preconfim the destruction of an employee
			 */
			destroy()
			{
				Confirmation.confirm("Are you Kidding","The Employee will be deleted permanently").
				then(accepted=>this.removeEmployee());
			},
			/**
			 * Removes an employee.
			 */
			removeEmployee()
			{
				axios.delete("/employees/"+this.employee.id).then(response=>{
					flash("Employee was deleted sucessfuly");
					window.location="/employees";

				})
			},
			/**
			 * handler for when the employee is edited
			 *
			 * @param      {Object}  employee  The employee
			 */
			edited(employee)
			{
				this.employeeCopy=employee;
				flash("The employee was update successfully");
				this.isEditing=false;
				
			},
			/**
			 * the employee has been paid, shut down the model and assign a clean copy
			 *
			 * @param      {Object}  employee  The employee
			 */
			employeePaid(employee)
			{
				this.isBeingPaid=false;
				this.employeeCopy=employee;
				flash("Employee was paid successfully!");
			}
		}
	}
</script>

<template>
	<card>
		<h4 slot="title">{{employee.name}}</h4>
		<div class="d-flex align-items-center justify-content-between text-center box px-5">
			<div>
				<img :src="employee.image" alt="" class="img-thumbnail rounded-circle">
			</div>
			<div>
				<p class="h4 text-muted">Responsiibility</p>
				<p class="h5">{{employee.responsibility}}</p>
			</div>
			<div>
				<p class="h4 text-muted">PhoneNumber</p>
				<p class="h5">{{employee.phoneNumber}}</p>
			</div>
			<div>
				<p class="h4 text-muted">Sex</p>
				<p class="h5">{{employee.sex|title}}</p>
			</div>
			<div class="btn-group" v-if="!readonly">
				<a role="button" class="btn btn-outline-primary" :href="'/employees/'+employee.id">
					<i class="fa fa-user-plus"></i>
					Details
				</a>
			</div>
		</div>
		
	</card>
</template>

<script>
	export default
	{
		props:{
			employee:{},
			readonly:{
				default:true
			}
		},

		data(){
			return {
			
			}
		}
	}
</script>

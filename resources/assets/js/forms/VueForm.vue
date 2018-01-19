<template>
	<form :action="action" @submit.prevent="onSubmit" 
	@keydown="form.errors.clear($event.target.name)">
		<slot></slot>
	<div :class="fieldsClass">
		<template v-for="field in rowedFields">
			<div class="row">
				<template v-if="Array.isArray(field)">
					<template v-for="f in field">
						<field :field="f"  :rowClass="rowClass" :form.sync="form"></field>
					</template>
				</template>
		
				<template v-else>
					<field :field="field" :rowClass="rowClass"  :form.sync="form"></field>
				</template>
			</div>
		
			</template>
	</div>
	<div class="form-group">
		<button type="submit" class="btn btn-primary">
			<i class="fa fa-save"></i>
			{{submitText|title}}
		</button>
	</div>
</form>

</template>
<script>

	import Form from "./Form";

	import Field from "./Field";

	export default{
		components:{Field},

		props:{
			fields:{
				required:true,
				type:Array
			},
			fieldsPerRow:{
				default:1,
				type:Number,

			},
			action:{
				required:true
			},
			submitText:{
				default:"Submit"
			},
			method:{
				default:"post"
			},
			fieldsClass:{
				default:null
			},
			beforeSubmitCallBack:{
				default:false
			}
		},

		data()
		{
			return {
				form:new Form(this.fields),
			}
		},

		methods:{
		

			onSubmit()
			{
				if (!this.beforeSubmitCallBack) {
					return this.submitForm();
				}

				this['beforeSubmitCallBack'](this.form).then(()=>{
					this.submitForm();
				})
				
			},
			submitForm()
			{
				this.form.submit(this.method,this.action).then((data)=>{
					this.$emit("submitted",data);
				});
			}

		},
		computed:{
			rowedFields()
			{
				if (this.fieldsPerRow<=1) {
					return this.fields;
				}
				return _.chunk(this.fields, this.fieldsPerRow);
			},
			rowClass()
			{
				if(this.fieldsPerRow<=1 || this.fieldsPerRow>12){
					return "col-md-12";
				}

				let rows= Math.ceil((12/this.fieldsPerRow))
				return  "col-md-"+rows;

			},


		}

	}
</script>

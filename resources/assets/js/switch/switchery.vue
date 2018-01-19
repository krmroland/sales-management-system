<template>
	<div>
		
		<div class="btn-group">
			<transition-group 
				enter-active-class="animated rotateInDownLeft"
				 leave-active-class="animated hinge"
				 mode="in-out"
				 move-class="animated bounceInLeft"
				 appear
				 tag="div"
							>
				<template v-for="button in buttonOptions">
					<button  v-if="!button.isActive"
						class="btn" :key="button.key" 
						:class="button.class?button.class:'btn-outline-info'"
						@click="activateButton(button.key)"
						>
						<i v-if="button.icon" :class="button.icon"></i>
						{{button.text}}
					</button>
				</template>
			</transition-group>

		</div>
	</div>
</template>
<script>

	import btn from "./TogglableButton";

	export default
	{
		components:{btn},

		props:{

			buttons:{
				default:function(){

					return [];
				},
			}
		},
		data()
		{

			return{
				buttonOptions:this.buttons
			}
		},
		methods:
		{
			activateButton(key)
			{
				this.buttonOptions.map((button,index)=>{
					this.$set(this.buttonOptions[index],'isActive',(key==button.key))
					this.$emit("switched",key);
				});

			}
		}
	}
</script>
<style>

</style>
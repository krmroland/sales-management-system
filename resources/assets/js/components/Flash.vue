<template>

	<div class="modal is-active" v-if="shouldShow">
		<div class="modal-background"></div>
		<zoom>
			<div class="modal-card">
				<section class="modal-card-body p-0 text-center">
					<div class="alert m-0 text-white":class="'bg-'+alertType">
						<strong class="d-flex justify-content-center mx-3 align-items-center">
							<i  class="fa p-1" :class="icon" ></i>
							<span v-html="body"></span>
						</strong>
					</div>
				</section>
			</div>
		</zoom>
	</div>
</template>
<script>
	export default
	{

		props:{

			message:{default:null},
			timeOut:{default:true},
			show:{default:false},
			type:{default:'success'}
		},


		data()
		{
			return {
				shouldShow:this.show,
				body:'',
				alertType:this.type,
			};
		},
		created() {
			if (this.message) {
				this.flash(this.message);
			}

			window.events.$on(
				'flash', data => this.flash(data.message,data.type)
				);
		},
		computed:{
			icon()
			{
				if (this.alertType=="success") {
					return "fa-check fa-3x";
				}
				return "fa fa-exclamation-triangle fa-3x";
			}
		},

		methods: {
			flash(message,type) {
				this.body = message;
				this.shouldShow = true;
				this.alertType=type;

				if (this.timeOut) {
					this.hide();
				}

			},

			hide() {
				setTimeout(() => {
					this.shouldShow = false;
				}, 2000);
			}
		}
	}
</script>

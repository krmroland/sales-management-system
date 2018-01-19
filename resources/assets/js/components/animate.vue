<template>
<div>
	<transition-group v-if="hasGroup"
		:enter-active-class="enterClass"
		:leave-active-class="leaveClass"
		:mode="mode">
			<slot></slot>
	</transition-group>
	<transition v-else="hasGroup"
		:enter-active-class="enterClass"
		:leave-active-class="leaveClass"
		:mode="mode">
		<slot></slot>
	</transition>

</div>

</template>
<script>
	export default
	{
		props:["mode","hasGroup","style"],

		data()
		{
			return {
				enterClass:'',
				leaveClass:''
			}

		},

		computed:{

			enterClass()
			{
				if (!this.in) {
					return "animated ZoomIn";
				}

				if (this.style=="fadeIn") {
					return "animated fadeIn";
				}

			},

		}

	}

</script>
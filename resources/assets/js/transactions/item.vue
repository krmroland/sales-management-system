<template>
	<div class="Item">
		<zoom>
			<div class="Item__masked text-center" v-if="hovered">
				<div class="d-flex align-items-center justify-content-between">
					<div class="bg-primary text-white p-2 px-5">
						{{item.availableQuantity}} {{item.bundle.unitPlural}} in stock
					</div>
					<div class="btn-group">
						<button class="btn btn-danger" @click="remove(item.item_id)">
							<i class="fa fa-trash"></i>
							Remove Item From the selection
						</button>
						<button  class="btn btn-info" @click="hovered=false">
							<i class="fa fa-times"></i>
							Close
						</button>
					</div>
				</div>

			</div>
		</zoom>

		<a href="" class="Item__wrapper" @click.prevent="hovered=true">
			<!-- headings -->
			<div class="Item__header row no-gutters p-0">

				<!-- 	buying price and name -->
				<div class="col-2 Item__head">
					{{item.name|title}} ({{type=="sale"?'Bought At':'Selling'}})
				</div>
				<!-- bundle quantity heading 	 -->
				<template v-if="item.bundleName">
					<div class="Item__head col-2">
						Qunatity in  ({{item.bundle.bundlePlural}})
					</div>
				</template>
				<!-- unit qunatity heading -->
				<div class="Item__head" :class="quantityClass">
					Qunatity in  ({{item.bundle.unitPlural}})
				</div>

				<!-- sold at heading -->
				<div class="Item__head col-2">
					{{ type=='sale'?'Sell At':'Purchased At'}}(@{{item.unitName}})
				</div>
				<!-- total qunatity heading -->
				<div class="Item__head col-2">
					All Qty({{item.bundle.unitPlural}})
				</div>

				<!-- total qunatity heading -->
				<div class="Item__head col-2">
					Sub total
				</div>
			</div>
		</a>
		<!-- end headings -->
		<!-- item rows -->
		<div class="Item__row row no-gutters">
			<!-- item name and buying price -->
			<div class="Item__text col-2" v-if="type=='sale'">
				<counter :value="Number(currentPrice)">		
				</counter>
			</div>
			<div class="Item__input col-2" v-else>
				<input type="number" class="form-control" v-model.number="currentPrice" step="0.5">
			</div>

			<!-- bundle quantity input	 -->
			<template v-if="item.bundleName">
				<div class="Item__input col-2">
					<input type="number" class="form-control" v-model="bundleQuantity">
				</div>
			</template>

			<!-- unit quantity inputs -->
			<!-- if we only have no bundles we will use a fill in box -->
			<div class="Item__input" v-if="!item.bundleName" :class="quantityClass">
				<input type="number" class="form-control" v-model.number="unitQuantity">
			</div>
			<div :class="quantityClass" class="Item__input"v-else>
				<select class="form-control" v-model.number="unitQuantity">
					<option value="0"> 0 ({{item.bundle.unitPlural}})</option>
					<template v-for="unit in Number(item.unitsPerBundle)-1">
						<option :value="unit">
							{{ unit}} ({{unit==1?item.unitName:item.bundle.unitPlural}})
						</option>
					</template>
				</select>
			</div>
			<!-- sold at input -->
			<div class="Item__input col-2">
				<input type="number" class="form-control" v-model="transactedAt" step="0.5">
			</div>
			<!-- total Quantitity -->
			<div class="Item__text col-2">
				<counter :value="Number(totalQuantity)"></counter>
			</div>
			<!-- subtotal -->
			<div class="Item__text col-2">
				<counter :value="Number(subTotal)"></counter>
			</div>
		</div>
		<!-- end rows -->
	</div>
</template>

<script>
	export default{

		props:["item","type"],

		data()
		{
			return {
				bundleQuantity:null,
				unitQuantity:null,
				hovered:false,
				transactedAt:this.getTransactionPrice(),
				currentPrice:this.getCurrentPrice()

			}
		},

		methods:{
			remove(item_id)
			{
				events.$emit("item:removed",item_id);
			},
			//generalized buying pric when purchasning and selling price when selling
			getTransactionPrice()
			{
				return Number(this.type=="sale"?this.item.sellingPrice:this.item.buyingPrice);

			},
			//buying pricewhen selling and selling price when buying
			getCurrentPrice()
			{

				return this.type=="sale"?this.item.buyingPrice
				:this.item.sellingPrice

			},
		},
		computed:{
			

			quantityClass()
			{
				return this.item.bundleName?'col-2':'col-4';
			},

			profitGain()
			{
				return 10000;
			},
			subTotal()
			{
				return this.totalQuantity*this.transactedAt;

			},
			totalQuantity()
			{
				return (Number(this.bundleQuantity)*Number(this.item.unitsPerBundle))
				+Number(this.unitQuantity);
			},
			formatedItem()
			{
				return {
					itemId:this.item.item_id,
					data:{
						transactedAt:this.transactedAt,
						total:Number(this.subTotal),
						quantity:Number(this.totalQuantity),
						item_id:Number(this.item.item_id),
						currentPrice:Number(this.currentPrice)
					}
					
				};
			}
		},
		watch:{
			subTotal(newValue){
				this.$emit("processed",this.formatedItem);

			},
			currentPrice(newValue)
			{
				this.$emit("processed",this.formatedItem);
			}
		}

	}
</script>

<style lang="scss">
	@import "resources/assets/sass/colors";

	.Item{

		$item-border-color:lighten($brand-primary,17);
		$item-background-color:lighten($brand-primary,17);

		position:relative;

		.Item__masked{
			z-index:2000;
			position:absolute;

			background-color:rgba(0,0,0,0.85);
			top:0;
			bottom:0;
			right:0;
			left:0;
			display:flex;
			align-items:center;
			justify-content:center;

			.contents{

			}

		}

		.Item__wrapper:hover{
			text-decoration:none;

		}
		.Item__wrapper:focus{
			text-decoration:none;

		}

		.Item__header{
			&:hover{
				//border:2px solid red;
				.Item__head{
					background-color:lighten($brand-primary,2);
					border:none;
				}
			}

			background-color:$item-background-color;

		}
		.Item__header, .Item__row{
			text-align:center;
			//border: 1px solid $item-border-color;
			border-collapse:collapse;
			//border:none;

			.Item__head{
				
				padding: 0.3rem;
				background-color:$item-background-color;
				color:$white;
				font-size:1em;

			}
		}

		.Item__row{

			border: 1px solid $item-border-color;
			padding:0;
				//padding: 0.75rem;

				.Item__input>.form-control{
					color:#636c72;
					height:100%;
					padding:0;
					padding: 0.5rem;
					font-size:1em;
					text-align:center;
					border: 1px solid $item-border-color;
				}
				.Item__input>select.form-control{
					height:100%;

				}
				.Item__text{

					border: 1px solid $brand-primary;
					display:flex;
					align-items:center;
					justify-content:center;
					font-size:1.4em;
					background-color:darken($white,10);
				}
			}


		}
	</style>
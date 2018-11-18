package dir.actionscript  {
	import flash.display.*;
	import flash.events.*;
	import flash.net.*;
	import flash.text.*;
	import flash.ui.*;
	import fl.transitions.easing.*;
	import fl.transitions.*;

	public class ASBox2  {
		private var asbox:Sprite;
		private var arrBtns:Array;
		private var arrIndex:uint;
		private var labels:Sprite;
		private var imgSet:Boolean;
		private var loader:Loader;
		private var overlay:Sprite;
		private var stg:Stage;
		private var stgH:uint;
		private var stgW:uint;
		private var tw:Tween;
		private var tw2:Tween;

		public function ASBox2(obj:MovieClip,W:uint,H:uint):void  {
			stg = obj.stage;
			stgW = W;
			stgH = H;

			imgSet = (obj.asboxID)?true :false;
			if(imgSet)  {
				arrIndex = obj.asboxID;
				createArrBtns(obj.parent);
			}

			stg.addEventListener(KeyboardEvent.KEY_DOWN,keyboardHandler);
			initOverlay();
			initAsbox();
			loadImage(obj);
		}

		private function createArrBtns(container:DisplayObjectContainer):void  {
			arrBtns = new Array();
			var child:DisplayObject;
			for (var i:uint=0; i < container.numChildren; i++)  {
				child = container.getChildAt(i);
				if(child is MovieClip && MovieClip(child).asboxID)  arrBtns[MovieClip(child).asboxID] = MovieClip(child);
			}
		}

		private function initOverlay():void  {
			overlay = new Sprite();
			overlay.graphics.beginFill(0x000000,.8);
			overlay.graphics.drawRect(0,0,stg.stageWidth,stg.stageHeight);
			overlay.graphics.endFill();
			
			stg.addEventListener(Event.RESIZE,resizeOverlayHandler);
			resizeOverlayHandler(null);
			tw = new Tween(overlay,'alpha',None.easeIn,0,1,.5,true);
			stg.addChild(overlay);
			initContextMenu(overlay);
		}

		private function resizeOverlayHandler(e:Event):void  {
			overlay.x = (stgW - stg.stageWidth) / 2;
			overlay.y = (stgH - stg.stageHeight) / 2;
			overlay.width = stg.stageWidth;
			overlay.height = stg.stageHeight;
		}

		private function initAsbox():void  {
			var asboxW:uint = Configuration.vars.ASBOX_STARTWIDTH;
			var asboxH:uint = Configuration.vars.ASBOX_STARTHEIGHT;

			asbox = new Sprite();
			asbox.x = (stgW - asboxW) / 2;
			asbox.y = ((stgH - stg.stageHeight) / 2) + Configuration.vars.ASBOX_MARGINTOP;
			asbox.graphics.beginFill(0xFFFFFF);
			asbox.graphics.drawRect(0,0,asboxW,asboxH);
			asbox.graphics.endFill();

			stg.addEventListener(Event.RESIZE,resizeAsboxHandler);
			stg.addChild(asbox);
			initContextMenu(asbox);
		}

		private function resizeAsboxHandler(e:Event):void  {
			asbox.y = ((stgH - stg.stageHeight) / 2) + Configuration.vars.ASBOX_MARGINTOP;
			if(loader && labels)  {
				loader.x = labels.x = asbox.x + 5;
				loader.y = labels.y = asbox.y + 5;
			}
		}

		private function loadImage(btn:MovieClip):void  {
			var sl:SimpleLoader = new SimpleLoader(btn.path,asbox);

			var borderSize:uint = Configuration.vars.ASBOX_BORDER;
			var speed:Number = Configuration.vars.ASBOX_MOTIONSPEED;
			sl.li.addEventListener(Event.COMPLETE,function()  {
				loader = sl.l;

				asbox.removeChild(loader);

				tw = new Tween(asbox,'height',Regular.easeIn,asbox.height,(loader.content.height + borderSize * 2),speed,true);

				tw.addEventListener(TweenEvent.MOTION_FINISH,function()  {
					tw = new Tween(asbox,'width',Regular.easeIn,asbox.width,(loader.content.width + borderSize * 2),speed,true);
					tw2 = new Tween(asbox,'x',Regular.easeIn,asbox.x,(asbox.x + ((asbox.width - loader.content.width - borderSize * 2) / 2)),speed,true);

					tw2.addEventListener(TweenEvent.MOTION_FINISH,function()  {
						loader.x = asbox.x + borderSize;
						loader.y = asbox.y + borderSize;
						tw = new Tween(loader,'alpha',None.easeIn,0,1,speed,true);
						stg.addChild(loader);
						initContextMenu(loader);

						labels = new Sprite();
						labels.x = loader.x;
						labels.y = loader.y;
						labels.addEventListener(KeyboardEvent.KEY_DOWN,keyboardHandler);
						stg.addChild(labels);
						initContextMenu(labels);

						var cl:Closelabel = new Closelabel();
						cl.txt.text = Configuration.vars.CLOSELABEL;
						cl.name = 'closelabel';
						cl.x = loader.width;
						cl.y = loader.height + borderSize;
						cl.buttonMode = true;
						cl.mouseChildren = false;
						cl.addEventListener(MouseEvent.CLICK,closeHandler);

						var txtHeight:uint = 0;
						var tformat:TextFormat = new TextFormat();
						tformat.size = 10;
						tformat.font = 'Verdana';
						tformat.color = 0x666666;

						if(btn.lbl)  {
							var tf:TextField = new TextField();
							tf.text = btn.lbl;
							tf.y = cl.y;
							tf.autoSize = TextFieldAutoSize.LEFT;
							tf.width = loader.width - cl.width - borderSize;
							tf.selectable = false;
							tf.wordWrap = true;
							tformat.bold = true;
							tf.setTextFormat(tformat);

							txtHeight += tf.height;
						}

						if(imgSet)  {
							if(arrIndex > 1)  {
								var prevHitArea:Sprite = new Sprite();
								prevHitArea.name = 'prevlabel';
								prevHitArea.buttonMode = true;
								prevHitArea.mouseChildren = false;
								prevHitArea.graphics.beginFill(0x00FF00,0);
								prevHitArea.graphics.drawRect(0,0,(loader.width / 2),loader.height);
								prevHitArea.graphics.endFill();
								prevHitArea.addEventListener(MouseEvent.ROLL_OVER,rollHandler);
								prevHitArea.addEventListener(MouseEvent.ROLL_OUT,rollHandler);
								prevHitArea.addEventListener(MouseEvent.CLICK,clickHandler);
								labels.addChild(prevHitArea);
							}

							if(arrIndex < (arrBtns.length - 1))  {
								var nextHitArea:Sprite = new Sprite();
								nextHitArea.name = 'nextlabel';
								nextHitArea.x = loader.width / 2;
								nextHitArea.buttonMode = true;
								nextHitArea.mouseChildren = false;
								nextHitArea.graphics.beginFill(0x00FF00,0);
								nextHitArea.graphics.drawRect(0,0,(loader.width / 2),loader.height);
								nextHitArea.graphics.endFill();
								nextHitArea.addEventListener(MouseEvent.ROLL_OVER,rollHandler);
								nextHitArea.addEventListener(MouseEvent.ROLL_OUT,rollHandler);
								nextHitArea.addEventListener(MouseEvent.CLICK,clickHandler);
								labels.addChild(nextHitArea);
							}

							var tf2:TextField = new TextField();
							tf2.text = Configuration.vars.IMAGE + btn.asboxID + ' / ' + (arrBtns.length - 1);
							tf2.y = cl.y + txtHeight;
							tf2.autoSize = TextFieldAutoSize.LEFT;
							tf2.selectable = false;
							tformat.bold = false;
							tf2.setTextFormat(tformat);

							txtHeight += tf2.height;
						}

						if(txtHeight == 0)  txtHeight = cl.height;

						tw = new Tween(asbox,'height',Regular.easeIn,asbox.height,(asbox.height + txtHeight + borderSize),speed,true);
						tw.addEventListener(TweenEvent.MOTION_FINISH,function()  {
							labels.addChild(cl);
							if(btn.lbl)  labels.addChild(tf);
							if(imgSet)  labels.addChild(tf2);
						});
					});
				});
			});
		}

		private function keyboardHandler(e:KeyboardEvent):void  {
			if(labels.getChildByName('closelabel') && e.keyCode == 27)  closeHandler(null);
			if((labels.getChildByName('prevlabel') && e.keyCode == 37) || (labels.getChildByName('nextlabel') && e.keyCode == 39))  {
				clickHandler(e);
			}
		}		

		private function closeHandler(e:MouseEvent):void  {
			stg.removeEventListener(KeyboardEvent.KEY_DOWN,keyboardHandler);
			stg.removeChild(labels);
			stg.removeChild(loader);
			stg.removeChild(asbox);
			tw = new Tween(overlay,'alpha',None.easeIn,1,0,.5,true);
			tw.addEventListener(TweenEvent.MOTION_FINISH,function()  {
				stg.removeChild(overlay);
			});
		}

		private function rollHandler(e:MouseEvent):void  {
			var currHitArea:DisplayObjectContainer = e.target as DisplayObjectContainer;

			if(e.type == 'rollOver')  {
				var lbl:MovieClip;
				if(currHitArea.name == 'prevlabel')  {
					lbl = new Prevlabel();
					lbl.txt.text = Configuration.vars.PREVLABEL;
					lbl.x = 0;
				}
				else  {
					lbl = new Nextlabel();
					lbl.txt.text = Configuration.vars.NEXTLABEL;
					lbl.x = currHitArea.width;
				}
				lbl.y = 40;
				currHitArea.addChild(lbl);
			}
			else  currHitArea.removeChild(currHitArea.getChildAt(0));
		}

		private function clickHandler(e:Event):void  {
			stg.removeChild(labels);
			stg.removeChild(loader);

			var type:String = e.type;
			switch(type)  {
				case 'keyDown':
					var ke:KeyboardEvent = e as KeyboardEvent;
					(ke.keyCode == 37)?arrIndex-- :arrIndex++;
				break;
				case 'click':
					(e.target.name == 'prevlabel')?arrIndex-- :arrIndex++;
				break;
			}

			loadImage(arrBtns[arrIndex]);
		}

		private function initContextMenu(obj:DisplayObjectContainer):void  {
			var cm:ContextMenu = new ContextMenu();
			cm.hideBuiltInItems();
			var item:ContextMenuItem = new ContextMenuItem('ASBox 2.0');
			cm.customItems.push(item);
			item.addEventListener(ContextMenuEvent.MENU_ITEM_SELECT,function(){
				navigateToURL(new URLRequest('http://www.marcellosurdi.name'));
			});
			obj.contextMenu = cm;
		}
	}
}
package dir.actionscript  {
	import flash.display.*;
	import flash.events.*;
	import flash.net.*;
	
	internal class SimpleLoader  {
		internal var l:Loader;
		internal var li:LoaderInfo;
		private var container:DisplayObjectContainer;
		private var imgPath:String;
		private var loading:Loading;
		
		public function SimpleLoader(addr:String,obj:DisplayObjectContainer):void  {
			imgPath = addr;
			container = obj;

			l = new Loader();
			li = l.contentLoaderInfo;
			li.addEventListener(IOErrorEvent.IO_ERROR,ioErrorHandler);
			li.addEventListener(Event.OPEN,openHandler);
			li.addEventListener(Event.COMPLETE,completeHandler);
			l.load(new URLRequest(addr));
			container.addChild(l);
		}

		private function ioErrorHandler(e:IOErrorEvent) {
			trace("Errore durante l'apertura dell'indirizzo " + imgPath);
		}

		private function openHandler(e:Event) {
			loading = new Loading();
			container.stage.addEventListener(Event.RESIZE,resizeHandler);
			resizeHandler(null);
			container.stage.addChild(loading);
		}

		private function completeHandler(e:Event) {
			container.stage.removeChild(loading);
		}

		private function resizeHandler(e:Event):void  {
			loading.x = container.x + ((container.width - loading.width) / 2);
			loading.y = container.y + ((container.height - loading.height) / 2);
		}
	}
}
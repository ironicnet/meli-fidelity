// Code goes here

function MessageCenter(options) {
	var self = this;
  	if (!options) options = {};
	self.hubs = [];
	self.courier = options.courier || null;
	self.defaultInterval = options.defaultInterval || 5000;
	self.base_url = options.base_url;


	self.suscribeToHub = function(hubId, listener, listeningInterval) {
		console.log('Suscribing to hub', hubId, listener);
		if (self.hubs[hubId]) {
			console.log('Hub already exists, adding listener', self.hubs);
			self.hubs[hubId].listeners.push(listener);
		} else {
			var hub = new Hub(hubId, self, {
				base_url: self.base_url,
				courier: self.courier,
				listeners: [listener]
			});


			self.hubs[hubId] = hub;
			console.log('Hub doesnt exists, adding new hub', self.hubs, hub);

				hub.startListening(listeningInterval || self.defaultInterval);
		}
	}
	self.notifyFromHub = function(hubId, message) {
		if (self.hubs[hubId]) {
			for (var i = self.hubs[hubId].listeners.length - 1; i >= 0; i--) {
				var listener = self.hubs[hubId].listeners[i];
				listener(hubId, message);
			};
		}
	}
	self.sendToHub = function(hubId, message) {
		if (self.hubs[hubId]) {
			self.hubs[hubId].send(message);
		}
	}

	console.log('MessageCenter', self)
	return self;
}

function Hub(hubId, messageCenter, options) {
	this.id = hubId;
	this.messageCenter = messageCenter;

	if (!options) options = {};
	this.base_url = options.base_url || '';
	this.courier = options.courier || null;
	this.listeners = options.listeners || [];
	this.timerRef = null;
	this.lastUpdate = null;
	this.lastInterval = null;
	this.listening = false;

	this.listen = function() {
		var self = this;
		if (this.listening) this.keepListening(this.lastInterval);
		if (this.courier) {
			this.courier.get(this.base_url, this.id, this.lastUpdate, function(err, data) {
				if (err) {
					throw err;
				} else {
					this.lastUpdate = new Date();
					self.messageCenter.notifyFromHub(self.id, data);
					
				}
			});
		} else {
			throw "No hay un courier definido para el MessageCenter";
		}
	}

	this.send = function(message) {
		console.log('Sending message to hub ', this.id, this, message)
		if (this.courier) {
			this.courier.send(this.base_url, this.id, message);
		} else {
			throw "No hay un courier definido para el MessageCenter";
		}

	};
	this.startListening = function(interval) {
		this.listening = true;
		console.log(this.id, 'Hub listening', interval);
		var self = this;
		this.lastInterval = interval;
		self.listen();
		console.log('ref', this.timerRef);

	};
	this.keepListening = function(interval) {
		this.listening = true;
		console.log(this.id, 'Hub listening', interval);
		var self = this;
		this.lastInterval = interval;
		 this.timerRef = setTimeout(function() { self.listen()}, interval);
		console.log('ref', this.timerRef);

	};
	this.stopListening = function() {
		this.listening = false;
		clearTimeout(this.timerRef);
		this.timerRef = null;
		console.log(this.id, 'Hub stopped listening');

	}
	return this;
}
//TEST

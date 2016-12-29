Vagrant.configure(2) do |config|
  config.vm.define "wall" do |t|
  end
  config.vm.provider "virtualbox" do |v|
    v.memory = 1024
    v.cpus = 2
  end
  config.vm.network "private_network", ip: "192.168.33.10" # wall.plainphp.dev wall.phalcon.dev
  config.vm.synced_folder "wall", "/var/www/html/wall"
  config.vm.box = "bento/ubuntu-16.04"
  config.vm.provision :shell, path: "vagrant/provision.sh"
end

VAGRANTFILE_API_VERSION = "2"

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|

  # box-config
  config.vm.box = "devops000"
  config.vm.box_url = "http://box.3wolt.de/devops000/"
  config.vm.box_check_update = true
  config.vm.box_version = "~> 1.0.0"

  # network-config
  config.vm.network "public_network"
  config.vm.boot_timeout = 600

  # SSH-config
  config.ssh.username = "root"
  config.ssh.password = '\g}xr+e#p@g1'
  config.ssh.insert_key = true

  # hostname
  config.vm.hostname = "TreeMDown-Multi"
  config.vm.post_up_message = "--\nWelcome to TreeMDown-Multi!\n\nThis VM delivers:\n\Application under: http://www.treemdown-multi.de\n\tDocumentation under: http://doc.treemdown-multi.de\n\tTests under: http://test.treemdown-multi.de\n\n--\n"

  # provisioners
  # ------------

  # nginx configs, copy and link
  config.vm.provision "file", source: "env/nginx/doc.conf", destination: "/etc/nginx/sites-available/doc"
  config.vm.provision "file", source: "env/nginx/test.conf", destination: "/etc/nginx/sites-available/test"
  config.vm.provision "file", source: "env/nginx/dist.conf", destination: "/etc/nginx/sites-available/dist"
  config.vm.provision "file", source: "env/vagrant/id_rsa", destination: "/root/.ssh/id_rsa"
  config.vm.provision "file", source: "env/vagrant/ssh_config", destination: "/root/.ssh/config"

  # shell commands
  config.vm.provision "shell", path: "env/vagrant/bootstrap.sh", run: "always"

end

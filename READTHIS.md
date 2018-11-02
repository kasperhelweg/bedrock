# Dependencies

    Composer. 1.7 is currently supported.

    VirtualBox. 5.2 is currently supported.  
    Vagrant TODO: Version=?

Developers should also install `Ansible`. 2.5.3 is currently supported.


# New Project

    git clone --depth=1 --recurse-submodules git@github.com:kasperhelweg/bedrock.git <project-name> && rm -rf {<project-name>,<project-name>/config/ops}/.git

# Setup

## Create valid vault-pass

    cd <project-name>/config/ops
    cp .vault_pass.example .vault_pass

The content of `.vault_pass` can be obtained from 1password (Ansible master password oct 2018).

## Variables

Variables of interest are found in `config/ops/group_vars` and grouped by environment. For most projects, relevant files include `wordpress_sites.yml` and `vault.yml`. All vault files are encrypted using `ansible-vault`. 

### Development

    cd config/ops

Edit `config/ops/group_vars/development/wordpress_sites.yml` and `config/ops/group_vars/development/vault.yml` to your liking.

    vagrant up

TODO : Automate basic setup

activate theme  
delete sample pages and set frontpage

Test the API installation,

    curl -H "accept: application/json" http://api.<project-name>.development.molamil.com/wp-json/mml/v1 | python -m json.tool


### Remotes

Add IPS to hosts and edit the same files as for dev

To provision a droplet
    



molamil

nginx... hash bucket (test)
components plugin add (test)
wordpress multiple urls for production
bitbucket pipelines


fluchtpunkt.io - un objet rituel?
DJ/Stripper/Performer/etc Sarah Angel
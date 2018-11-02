# Dependencies

    Composer. 1.7 is currently supported.

    VirtualBox. 5.2 is currently supported.  
    Vagrant TODO: Version=?

Developers should also install `Ansible`. 2.5.3 is currently supported.


# New Project

    git clone --depth=1 --recurse-submodules git@github.com:kasperhelweg/bedrock.git <project-name> && rm -rf {<project-name>,<project-name>/config/ops}/.git

# Setup

The remainder of this document assumes your cursor is at `<project-name>/config/ops`

    cd <project-name>/config/ops

## Create valid vault-pass

    cp .vault_pass.example .vault_pass

The content of `.vault_pass` can be obtained from 1password (Ansible master password oct 2018).

## Variables

Variables of interest are found in `group_vars/` and are grouped by environment. For most projects, relevant files include `wordpress_sites.yml` and `vault.yml`. All vault files are encrypted using `ansible-vault`. 

### Development

Edit `config/ops/group_vars/development/wordpress_sites.yml` and `config/ops/group_vars/development/vault.yml` to your liking.

    cd config/ops
    vagrant up

During the provisioning of the local environment you will be asked for your password.

TODO : Automate basic setup
- activate theme  
- delete sample pages and set frontpage

Test the API installation,

    curl -H "accept: application/json" http://api.<project-name>.development.molamil.com/wp-json/mml/v1/ | python -m json.tool

The admin interface is located at 

    http://api.<project-name>.development.molamil.com/wp/wp-admin/

OBS!  
In some cases it may be necessary to manually rewrite the wp permalink structure(`/%postname%/`) for everything to work.


### Remotes

Edit `group_vars/<environment>/wordpress_sites.yml` and `group_vars/<environment>/vault.yml` to your liking.  
Edit `hosts/<environment>` to reflect your server setup.  

    ansible-galaxy install -r requirements.yml
    ansible-playbook -e env=<environment> server.yml

The above task will fail if SSL is enabled for the environment but the DNS entry is missing.

#### Deploying

Local deploys are executed using

    ./bin/deploy.sh production api.<project-name>.molamil.com

However, you would usually deploy using a bitbucket pipeline.

##### How it works

The deploy scripts are executed in a docker-container that will need access to your server instance. On the other hand, the server instance needs access to bitbucket in order to clone the latest codebase. Thus, we need bi-directional SSH access.  

First ssh into your server instance as the web user

    ssh web@server_ip
    ssh-keygen -t rsa -b 4096 -C "<your_email_initials>+deploy@molamil.com"

Copy the generated public key and add it to the bitbucket repo(settings/access keys).  
Next generate a bitbucket key(pipelines/SSH keys). Add the generated key to the web users authorized_keys. Also, add the server instance to bitbuckets known hosts by fetching its fingerprint.

Since the vault files are encrypted, the docker-image will need access to the vault master password. Currently this is set as a global bitbucket environment variable called `ANSIBLE_VAULT_PASSWORD`

You are now all set to deploy using an appropriate pipeline.

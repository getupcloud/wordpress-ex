Wordpress Escalável no Openshift
================================

Este repositório git lhe ajuda a configurar e instalar o Wordpress com suporte a escalabilidade de maneira rápida. 
Os plugins abaixo estão pré-configurados:

* W3 Total Cache ( https://wordpress.org/plugins/w3-total-cache/ )
* Amazon Web Services ( https://wordpress.org/plugins/amazon-web-services/ )
* WP Offload S3 ( https://wordpress.org/plugins/amazon-s3-and-cloudfront/ )


Instalação:
-----------------------
Para instalar basta fazer um fork deste repositório e utilizar o oc para importar o template e criar a aplicação:

<pre>
$ oc create -f https://raw.githubusercontent.com/getupcloud/origin-templates/master/wordpress-template.yaml
$ oc new-app --template=wordpress-example --param=SOURCE_REPOSITORY_URL=http://seu_repo/repo.git
</pre>

Temas e Plugins
-----------------------
Os temas e plugins devem ser copiados para os devidos diretórios no repositório local.

* wp-content/themes/
* wp-content/plugins/


Segurança
-----------------------
Verifique a documentação do Wodpress para melhores práticas de segurança. O OpenShift gera automaticamente as chaves
de secretas no wp-config.php.

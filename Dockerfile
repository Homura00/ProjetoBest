# Use a imagem oficial do PHP com Apache
FROM php:8.2-apache

# Instalar extensões PHP necessárias
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Habilitar mod_rewrite do Apache
RUN a2enmod rewrite

# Configurar o DocumentRoot
ENV APACHE_DOCUMENT_ROOT /var/www/html

# Atualizar a configuração do Apache
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Copiar arquivos da aplicação
COPY . /var/www/html/

# Definir permissões corretas
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 755 /var/www/html

# Expor a porta 80
EXPOSE 80

# Comando para iniciar o Apache
CMD ["apache2-foreground"]

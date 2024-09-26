=======
# Use a imagem base do PHP com Apache
FROM php:7.4-apache

# Copie o conteúdo do seu site para o diretório raiz do servidor
COPY . /var/www/html/

# Habilite o módulo de reescrita do Apache, caso necessário
RUN a2enmod rewrite

# Exponha a porta 80
EXPOSE 80
>>>>>>> 8db5931 (Commit inicial)

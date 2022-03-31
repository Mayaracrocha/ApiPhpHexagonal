FROM postgres:13.2

RUN apt-get update
RUN echo "pt_BR.ISO-8859-1 ISO-8859-1" >> /etc/locale.gen
RUN locale-gen
RUN update-locale LANG=pt_BR.ISO-8859-1
RUN localedef -i pt_BR -c -f ISO-8859-1 -A /usr/share/locale/locale.alias pt_BR.ISO-8859-1
ENV LANG pt_BR.ISO-8859-1

ADD ./init.sql /docker-entrypoint-initdb.d/

EXPOSE 5432
CMD ["postgres"]

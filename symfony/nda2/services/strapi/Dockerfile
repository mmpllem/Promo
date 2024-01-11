FROM node:20.6-alpine3.18 AS base
RUN apk update && apk add --no-cache build-base gcc autoconf automake zlib-dev libpng-dev nasm bash vips-dev

WORKDIR /opt/app
COPY ./package*.json /opt/app
RUN npm config set fetch-retry-maxtimeout 600000 -g && npm install
RUN chown -R node:node /opt/app
USER node
FROM base AS app-dev
CMD ["npm", "run", "develop"]

FROM base AS app-prod
COPY ./ /opt/app
RUN ["npm", "run", "build"]

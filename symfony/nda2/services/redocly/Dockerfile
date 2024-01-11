FROM node:20.5.0 AS base
RUN yarn global add @redocly/cli
WORKDIR /app

FROM base AS redocly-dev
ENV REDOCLY_PORT=8081
CMD ["sh", "-c", "redocly preview-docs -h 0.0.0.0 -p ${REDOCLY_PORT} openapi.yaml"]

FROM base AS redocly-prod
CMD ["redocly", "bundle","api.yaml","--output","bundled.yaml"]

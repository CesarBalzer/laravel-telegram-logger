# Makefile para versionamento semântico
# Use: make tag-patch / tag-minor / tag-major

# Última versão do repositório
LAST_TAG := $(shell git describe --tags --abbrev=0 2>/dev/null || echo "v1.0.0")

define bump_version
	@echo "Versão atual: $(LAST_TAG)"
	@MAJOR=$$(echo $(LAST_TAG) | cut -d. -f1 | tr -d 'v'); \
	MINOR=$$(echo $(LAST_TAG) | cut -d. -f2); \
	PATCH=$$(echo $(LAST_TAG) | cut -d. -f3); \
	$(1); \
	NEW_TAG="v$$MAJOR.$$MINOR.$$PATCH"; \
	echo "🔖 Criando nova tag: $$NEW_TAG"; \
	git tag $$NEW_TAG; \
	git push origin $$NEW_TAG;
endef

tag-patch:
	$(call bump_version,PATCH=$$((PATCH+1)))

tag-minor:
	$(call bump_version,MINOR=$$((MINOR+1)); PATCH=0)

tag-major:
	$(call bump_version,MAJOR=$$((MAJOR+1)); MINOR=0; PATCH=0)

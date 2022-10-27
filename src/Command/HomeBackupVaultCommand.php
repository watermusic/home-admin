<?php

namespace App\Command;

use App\Service\PCloudApi;
use pCloud\Sdk\Exception;
use pCloud\Sdk\File;
use pCloud\Sdk\Folder;
use PhpZip\Exception\ZipException;
use PhpZip\ZipFile;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'home:backup-vault',
    description: 'Backups the bitwarden vault to the pcloud storage',
)]
class HomeBackupVaultCommand extends Command
{
    private PCloudApi $pCloudApi;

    public function __construct(PCloudApi $pCloudApi)
    {
        $this->pCloudApi = $pCloudApi;

        parent::__construct();
    }

    protected function configure(): void
    {
    }

    /**
     * @throws Exception
     * @throws ZipException
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $basePath = "/home/yoshimo/vaultwarden";

        $io = new SymfonyStyle($input, $output);

        $io->info("Starting upload...");


        $io->info("Zip files start...");

        $zipPath = $basePath . "/upgrade/vault.backup."  .  date("N") . ".zip";
        $zipFile = new ZipFile();
        $zipFile
            ->addDirRecursive($basePath . "/output/data")
            ->addFile($basePath . "/output/.env")
            ->saveAsFile($zipPath)
            ->close();

        $io->info("...zip files stop.");


        $io->info("Upload zip file start...");

        $destFolderId = 4428475451;
        $file = new File($this->pCloudApi->api);
        $file->upload($zipPath, $destFolderId);

        $io->info("...Upload zip file end.");

        return Command::SUCCESS;
    }
}

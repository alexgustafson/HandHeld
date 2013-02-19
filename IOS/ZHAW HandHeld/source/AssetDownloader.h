//
//  AssetDownloader.h
//  ZHAW HandHeld
//
//  Created by Alexander Gustafson on 12.02.13.
//  Copyright (c) 2013 Alexander Gustafson. All rights reserved.
//

#import <Foundation/Foundation.h>
#import "SqLiteDatabaseManager.h"

@protocol AssetDownloaderDelegate <NSObject>

-(void)setDownloaderStatus:(NSString *)status;
-(void)setDBPath:(NSString *)dbpath;
-(void)createLoggerMessage:(NSString *)message;

@end

@interface AssetDownloader : NSObject
{
    NSString* hostAssetsURL;
    NSURL* localFileURL;
    NSFileHandle* dbFile;
    NSData* _responseData;
    NSURLConnection* _connection_for_db_download;
    NSURLConnection* _connection_for_file_download;
    id <AssetDownloaderDelegate> delegate;
    
    NSMutableArray *fileDownloadQueue;
    NSOutputStream *stream;
}

@property (retain) id<AssetDownloaderDelegate> delegate;

-(void)downloadDBFile;
-(void)downloadAsset:(NSString *)assetName andTargetPath:(NSString *)targetPath;
-(void)downloadAssetList:(NSArray *)assetNameList;
-(void)downloadAssetListSynchronous:(NSArray *)assetNameList;

@end
